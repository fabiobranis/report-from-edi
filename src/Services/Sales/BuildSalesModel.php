<?php


namespace App\Services\Sales;


use App\DTO\Customer;
use App\DTO\Sales;
use App\DTO\SalesFile;
use App\DTO\Salesman;
use App\Reader\Exceptions\EndOfFileException;
use App\Reader\FileStream;

/**
 * It's kand a factory or a builder class that builds a DTO based on the lines of a file
 * Class BuildSalesModel
 * @package App\Services\Sales
 */
class BuildSalesModel
{

    /**
     * An instance of the file
     * @var FileStream
     */
    private $fileStream;

    /**
     * @var SalesFile
     */
    private $salesFile;

    /**
     * BuildSalesModel constructor.
     * @param FileStream $fileStream
     */
    public function __construct(FileStream $fileStream)
    {
        $this->fileStream = $fileStream;
        $this->salesFile = new SalesFile();
    }

    /**
     * Make the DTO based on the file data
     * @return SalesFile
     * @throws EndOfFileException
     */
    public function make(): SalesFile
    {

        while ($this->fileStream->hasLine()) {
            $dto = LineToDtoFactory::getDtoInstance($this->fileStream->readLine());
            if (is_a($dto, Salesman::class)) {
                $this->salesFile->insertSalesman($dto);
            } elseif (is_a($dto, Customer::class)) {
                $this->salesFile->insertCustomer($dto);
            } elseif (is_a($dto, Sales::class)) {
                $this->salesFile->insertSales($dto);
            }
        }
        return $this->salesFile;

    }

}