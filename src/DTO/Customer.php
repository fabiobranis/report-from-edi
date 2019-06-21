<?php


namespace App\DTO;

/**
 * A simple DTO
 * Class Customer
 * @package App\DTO
 */
class Customer
{

    /**
     * @var string
     */
    private $cnpj;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $businessArea;

    /**
     * Customer constructor.
     * @param string $cnpj
     * @param string $name
     * @param string $businessArea
     */
    public function __construct(string $cnpj, string $name, string $businessArea)
    {
        $this->cnpj = $cnpj;
        $this->name = $name;
        $this->businessArea = $businessArea;

    }

    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBusinessArea(): string
    {
        return $this->businessArea;
    }

}