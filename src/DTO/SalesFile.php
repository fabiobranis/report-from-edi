<?php


namespace App\DTO;

/**
 * A DTO to hold the file data
 * The meaning of this class is to make easier the report's calculations
 * Class SalesFile
 * @package App\DTO
 */
class SalesFile
{

    /**
     * An array of Salesman DTO's
     * @var array
     */
    private $salesmans = [];

    /**
     * An array of Customers DTO's
     * @var array
     */
    private $customers = [];

    /**
     * An array of Sales DTO's
     * @var array
     */
    private $sales = [];

    /**
     * @return array
     */
    public function getSalesmans(): array
    {
        return $this->salesmans;
    }

    /**
     * Insert a Salesman into the array
     * @param Salesman $salesman
     */
    public function insertSalesman(Salesman $salesman): void
    {
        $this->salesmans[] = $salesman;
    }

    /**
     * @return array
     */
    public function getCustomers(): array
    {
        return $this->customers;
    }

    /**
     * Insert a Customer into the array
     * @param Customer $customer
     */
    public function insertCustomer(Customer $customer): void
    {
        $this->customers[] = $customer;
    }

    /**
     * @return array
     */
    public function getSales(): array
    {
        return $this->sales;
    }

    /**
     * Insert a Sales into the array
     * @param Sales $sales
     */
    public function insertSales(Sales $sales): void
    {
        $this->sales[] = $sales;
    }



}