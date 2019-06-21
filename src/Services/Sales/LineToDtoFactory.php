<?php


namespace App\Services\Sales;


use App\DTO\Customer;
use App\DTO\Sales;
use App\DTO\SalesItem;
use App\DTO\Salesman;

/**
 * A factory to create a DTO instance according the EDI line ID
 * Class LineToDtoFactory
 * @package App\Services\Sales
 */
class LineToDtoFactory
{

    /**
     * The column delimiter
     * @var string
     */
    private static $separator = ',';

    /**
     * The item column delimiter
     * @var string
     */
    private static $itemSeparator = '-';

    /**
     * ID position in EDI line
     * @var int
     */
    private static $idPos = 0;

    /**
     * List of EDI indexes
     * @var array
     */
    private static $indexes = [
        '001' => [
            'cpf' => 1,
            'name' => 2,
            'salary' => 3,
        ],
        '002' => [
            'cnpj' => 1,
            'name' => 2,
            'business_area' => 3,
        ],
        '003' => [
            'id' => 1,
            'salesmanId' => 2,
            'salesItem' => 3,
        ],
    ];

    /**
     * List of sales item indexes
     * @var array
     */
    private static $itemIndexes = [
        'id' => 0,
        'quantity' => 1,
        'price' => 2
    ];

    /**
     * Returns the DTO instance
     * @param string $line
     * @return Customer|Sales|Salesman
     */
    public static function getDtoInstance(string $line)
    {

        // take line contents as an array
        $contents = explode(self::$separator, $line);
        $lineId = $contents[self::$idPos];
        switch ($lineId) {
            case '001':
                return new Salesman(
                    $contents[self::$indexes[$lineId]['cpf']],
                    $contents[self::$indexes[$lineId]['name']],
                    (float)$contents[self::$indexes[$lineId]['salary']]
                );
            case '002':
                return new Customer(
                    $contents[self::$indexes[$lineId]['cnpj']],
                    $contents[self::$indexes[$lineId]['name']],
                    $contents[self::$indexes[$lineId]['business_area']]
                );
            case '003':

                // remove the items from line
                $contents = explode(',', preg_replace('/(\[.*?\])([,])/', '', $line));

                // find the items - will be in the index 1
                preg_match('/\[(.*)\]/', $line, $b);
                $contents[] = explode(self::$separator, $b[1]);
                $salesItems = [];

                // create the sales items instances into the array
                foreach ($contents[self::$indexes[$lineId]['salesItem']] as $item) {
                    $data = explode(self::$itemSeparator, $item);
                    $salesItems[] = new SalesItem(
                        $data[self::$itemIndexes['id']],
                        (int)$data[self::$itemIndexes['quantity']],
                        (int)$data[self::$itemIndexes['price']],
                        );
                }

                return new Sales(
                    (int)$contents[self::$indexes[$lineId]['id']],
                    $salesItems,
                    $contents[self::$indexes[$lineId]['salesmanId']]
                );
        }
    }

}