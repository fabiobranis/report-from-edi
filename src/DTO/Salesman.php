<?php


namespace App\DTO;

/**
 * A simple DTO
 * Class Salesman
 * @package App\DTO
 */
class Salesman
{

    /**
     * @var string
     */
    private $cpf;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $salary;

    /**
     * Salesman constructor.
     * @param string $cpf
     * @param string $name
     * @param float $salary
     */
    public function __construct(string $cpf, string $name, float $salary)
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->salary = $salary;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

}