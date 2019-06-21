<?php


namespace Test\Reports;


use App\Reader\Exceptions\EndOfFileException;
use App\Reader\FileStream;
use App\Reports\Exceptions\NullOrZeroSalesmanException;
use App\Reports\SalesReport;
use App\Services\Sales\BuildSalesModel;
use ReflectionException;
use Storage\FileManager;
use Test\FileTestContext;

class SalesReportTest extends FileTestContext
{

    /**
     * @var FileStream
     */
    private $fileStream;

    /**
     * SalesReportTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->fileStream = new FileStream(
            new FileManager(
                $this->filePath,
                $this->outputFolder
            )
        );
    }

    /**
     * @throws EndOfFileException
     * @throws NullOrZeroSalesmanException
     * @throws ReflectionException
     */
    public function testReportCalculations(): void
    {
        $builder = new BuildSalesModel($this->fileStream);
        $report = new SalesReport($builder->make());
        $report->handle();

        $this->assertIsInt($report->getTotalCustomers());
        $this->assertIsInt($report->getTotalSalesman());
        $this->assertIsFloat($report->getAverageSalesmanSalary());
        $this->assertIsInt($report->getMostExpensiveSaleId());
        $this->assertIsString($report->getWorstSalesmanName());
        $this->assertEquals(2,$report->getTotalCustomers());
        $this->assertEquals(2,$report->getTotalSalesman());
        $this->assertEquals(70000.495,$report->getAverageSalesmanSalary());
        $this->assertEquals(10,$report->getMostExpensiveSaleId());
        $this->assertEquals('Elias',$report->getWorstSalesmanName());

        $this->assertIsArray($report->toArray());

    }


}