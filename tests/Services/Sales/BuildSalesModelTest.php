<?php


namespace Test\Services\Sales;


use App\DTO\SalesFile;
use App\Reader\Exceptions\EndOfFileException;
use App\Reader\FileStream;
use App\Services\Sales\BuildSalesModel;
use Storage\FileManager;
use Test\FileTestContext;

/**
 * Class BuildSalesModelTest
 * @package Test\Services\Sales
 */
class BuildSalesModelTest extends FileTestContext
{

    /**
     * @throws EndOfFileException
     */
    public function testDtoInstance(): void
    {
        $builder = new BuildSalesModel(
            new FileStream(
                new FileManager($this->filePath, $this->outputFolder)
            )
        );
        $dto = $builder->make();
        $this->assertInstanceOf(SalesFile::class, $dto);
        $this->assertIsArray($dto->getSalesmans());
        $this->assertIsArray($dto->getCustomers());
        $this->assertIsArray($dto->getSales());

    }

}