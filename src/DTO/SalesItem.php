<?php


namespace App\DTO;

/**
 * A simple DTO
 * Class SalesItem
 * @package App\DTO
 */
class SalesItem
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $price;

    /**
     * SalesItem constructor.
     * @param int $id
     * @param int $quantity
     * @param float $price
     */
    public function __construct(int $id, int $quantity, float $price)
    {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

}