<?php


namespace App\DTO;

/**
 * A simple DTO
 * Class Sales
 * @package App\DTO
 */
class Sales
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $salesItem;

    /**
     * @var string
     */
    private $salesManId;

    /**
     * Sales constructor.
     * @param int $id
     * @param array $salesItem
     * @param string $salesManId
     * @param Salesman $salesman
     */
    public function __construct(int $id, array $salesItem, string $salesManId)
    {
        $this->id = $id;
        $this->salesItem = $salesItem;
        $this->salesManId = $salesManId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getSalesItem(): array
    {
        return $this->salesItem;
    }

    /**
     * @return string
     */
    public function getSalesManId(): string
    {
        return $this->salesManId;
    }

}