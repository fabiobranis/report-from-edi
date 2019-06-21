<?php


namespace Test\Services\Sales;

use App\DTO\Customer;
use App\DTO\Sales;
use App\DTO\SalesItem;
use App\DTO\Salesman;
use App\Services\Sales\LineToDtoFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class LineToDtoFactoryTest
 * @package Test\Services\Sales
 */
class LineToDtoFactoryTest extends TestCase
{

    /**
     * Assert that line 001 will produce a valid Salesman DTO - based on Steve profile
     */
    public function testLineId001Steve(): void
    {
        $line = '001,1234567891234,Steve,80000';
        $dto = LineToDtoFactory::getDtoInstance($line);
        $this->assertInstanceOf(Salesman::class,$dto);
        $this->assertIsString($dto->getCpf());
        $this->assertIsString($dto->getName());
        $this->assertIsFloat($dto->getSalary());
    }

    /**
     * Assert that line 001 will produce a valid Salesman DTO - based on Elias Profile
     */
    public function testLineId001Elias(): void
    {
        $line = '001,3245678865434,Elias,60000.99';
        $dto = LineToDtoFactory::getDtoInstance($line);
        $this->assertInstanceOf(Salesman::class,$dto);
        $this->assertIsString($dto->getCpf());
        $this->assertIsString($dto->getName());
        $this->assertIsFloat($dto->getSalary());
    }

    /**
     * Assert that line 002 will produce a valid Customer DTO - based on Rita Ruggs profile
     */
    public function testLineId002Rita(): void
    {
        $line = '002,2345675434544345,Rita Ruggs,Rural';
        $dto = LineToDtoFactory::getDtoInstance($line);
        $this->assertInstanceOf(Customer::class,$dto);
        $this->assertIsString($dto->getCnpj());
        $this->assertIsString($dto->getName());
        $this->assertIsString($dto->getBusinessArea());
    }

    /**
     * Assert that line 002 will produce a valid Customer DTO - based on Dianne Bragg profile
     */
    public function testLineId002Dianne(): void
    {
        $line = '002,2345675433444345,Dianne Bragg,Rural';
        $dto = LineToDtoFactory::getDtoInstance($line);
        $this->assertInstanceOf(Customer::class,$dto);
        $this->assertIsString($dto->getCnpj());
        $this->assertIsString($dto->getName());
        $this->assertIsString($dto->getBusinessArea());
    }

    /**
     * Assert that line 003 will produce a valid Sales DTO - based on id 10
     */
    public function testLineId003Id10(): void
    {
        $line = '003,10,[1-10-100,2-30-2.50,3-40-3.10],Steve';
        $dto = LineToDtoFactory::getDtoInstance($line);
        $this->assertInstanceOf(Sales::class,$dto);
        $this->assertIsInt($dto->getId());
        $this->assertIsArray($dto->getSalesItem());
        $this->assertIsString($dto->getSalesManId());
    }

    /**
     * Assert that line 003 will produce a valid Sales DTO - based on id 10
     */
    public function testLineId003Id08(): void
    {
        $line = '003,08,[1-34-10,2-33-1.50,3-40-0. 10],Elias';
        $dto = LineToDtoFactory::getDtoInstance($line);
        $this->assertInstanceOf(Sales::class,$dto);
        $this->assertIsInt($dto->getId());
        $this->assertIsArray($dto->getSalesItem());
        $this->assertIsString($dto->getSalesManId());

        foreach ($dto->getSalesItem() as $item) {
            /** @var $item SalesItem */
            $this->assertInstanceOf(SalesItem::class, $item);
            $this->assertIsInt($item->getId());
            $this->assertIsInt($item->getQuantity());
            $this->assertIsFloat($item->getPrice());
        }

    }


}