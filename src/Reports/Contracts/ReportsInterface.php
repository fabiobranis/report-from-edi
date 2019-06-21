<?php


namespace App\Reports\Contracts;

/**
 * Interface ReportsInterface
 * @package App\Reports\Contracts
 */
interface ReportsInterface
{

    /**
     * Runs the report and returns the instance
     * @return ReportsInterface
     */
    public function handle(): self;

}