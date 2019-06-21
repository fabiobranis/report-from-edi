<?php


namespace App\Reports;


use App\DTO\Sales;
use App\DTO\SalesFile;
use App\DTO\SalesItem;
use App\DTO\Salesman;
use App\Reports\Contracts\ReportsInterface;
use App\Reports\Exceptions\NullOrZeroSalesmanException;
use App\Reports\Traits\SerializesToArray;

/**
 * Class SalesReport
 * @package App\Reports
 */
class SalesReport implements ReportsInterface
{

    use SerializesToArray;

    /**
     * The File DTO
     * @var SalesFile
     */
    private $salesFile;

    /**
     * The sum of customers in the file
     * @var int
     */
    private $totalCustomers;

    /**
     * The sum of salesman in the file
     * @var int
     */
    private $totalSalesman;

    /**
     * The average salary of salesman in the file
     * @var float
     */
    private $averageSalesmanSalary;

    /**
     * The id of the most expensive sale in the file
     * @var int
     */
    private $mostExpensiveSaleId;

    /**
     * The name of the worst salesman in the file
     * @var string
     */
    private $worstSalesmanName;

    /**
     * SalesReport constructor.
     * @param SalesFile $salesFile
     */
    public function __construct(SalesFile $salesFile)
    {
        $this->salesFile = $salesFile;
    }

    /**
     * Runs the report and returns the instance
     * @return ReportsInterface
     * @throws NullOrZeroSalesmanException
     */
    public function handle(): ReportsInterface
    {
        $this->calculateTotalCustomers();
        $this->calculateTotalSalesman();
        $this->calculateAverageSalesmanSalary();
        $this->setMostExpensiveSaleId();
        $this->setWorstSalesmanName();
        return $this;
    }

    /**
     * Count the customers
     */
    private function calculateTotalCustomers(): void
    {
        $this->totalCustomers = count($this->salesFile->getCustomers());
    }

    /**
     * Count the salesman
     */
    private function calculateTotalSalesman(): void
    {
        $this->totalSalesman = count($this->salesFile->getSalesmans());
    }

    /**
     * Calculate average salary
     * @throws NullOrZeroSalesmanException
     */
    private function calculateAverageSalesmanSalary(): void
    {

        // if salesman quantity is null or zero the system throws an exception
        if (!$this->totalSalesman) {
            throw new NullOrZeroSalesmanException('Invalid salesman quantity');
        }

        // here is a simple array reduce and a average calculation
        $this->averageSalesmanSalary = array_reduce(
                $this->salesFile->getSalesmans(),
                function (float $carry, Salesman $salesMan) {
                    return $salesMan->getSalary() + $carry;
                },
                0
            ) / $this->totalSalesman;
    }

    /**
     * Set the most expensive sale id
     */
    private function setMostExpensiveSaleId(): void
    {

        // get the sales total amounts and its id's
        $salesData = $this->getTotalSalesById();

        // to get the most expensive sale id we need to search the key (id) of the max value in the array
        $this->mostExpensiveSaleId = array_keys($salesData,max($salesData))[0];

    }

    /**
     * Calculate all sales totals and return them with the id
     * @return array
     */
    private function getTotalSalesById(): array
    {

        $salesData = [];

        // first we need to iterate over the sales
        foreach ($this->salesFile->getSales() as $sales) {
            /** @var $sales Sales */

            // then we reduce the sales items to get the sum of they
            $salesData[$sales->getId()] = array_reduce(
                $sales->getSalesItem(),
                function (float $carry, SalesItem $salesItem) {
                    // remember "the sale is price * quantity)
                    return ($salesItem->getPrice() * $salesItem->getQuantity()) + $carry;
                },
                0
            );
        }

        return $salesData;
    }

    /**
     * Set the worst salesman based on total sales
     */
    private function setWorstSalesmanName(): void
    {
        $salesmanSums = $this->getTotalSalesBySalesman();
        // to get the worst salesman id we need to search the key (id) of the min value in the array
        $this->worstSalesmanName = array_keys($salesmanSums,min($salesmanSums))[0];
    }

    /**
     * Calculate the total sales by salesman and return an array
     * @return array
     */
    private function getTotalSalesBySalesman(): array
    {
        $salesData = [];

        // first we need to iterate over the sales
        foreach ($this->salesFile->getSales() as $sales) {
            /** @var $sales Sales */

            // then we reduce the sales items to get the sum of they into an array of salesmans
            $salesData[$sales->getSalesManId()][] = array_reduce(
                $sales->getSalesItem(),
                function (float $carry, SalesItem $salesItem) {
                    // remember "the sale is price * quantity)
                    return ($salesItem->getPrice() * $salesItem->getQuantity()) + $carry;
                },
                0
            );
        }

        $salesmanTotals = [];

        foreach ($salesData as $salesman =>  $sales) {
            $salesmanTotals[$salesman] = array_sum($sales);
        }

        return $salesData;
    }

    /**
     * @return int
     */
    public function getTotalCustomers(): int
    {
        return $this->totalCustomers;
    }

    /**
     * @return int
     */
    public function getTotalSalesman(): int
    {
        return $this->totalSalesman;
    }

    /**
     * @return float
     */
    public function getAverageSalesmanSalary(): float
    {
        return $this->averageSalesmanSalary;
    }

    /**
     * @return int
     */
    public function getMostExpensiveSaleId(): int
    {
        return $this->mostExpensiveSaleId;
    }

    /**
     * @return string
     */
    public function getWorstSalesmanName(): string
    {
        return $this->worstSalesmanName;
    }

}