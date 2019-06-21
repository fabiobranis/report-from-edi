<?php


namespace App\Reports\Traits;

use ReflectionClass;
use ReflectionException;

/**
 * Trait SerializesToArray
 * @package App\Reports\Traits
 */
trait SerializesToArray
{

    /**
     * Serializes the scalar properties to an array using reflection
     * @return array
     * @throws ReflectionException
     */
    public function toArray()
    {
        $reflectionClass = new ReflectionClass(get_class($this));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {

            $property->setAccessible(true);
            $value = $property->getValue($this);
            // for this simple implementation the method will only return scalar types
            if (!is_scalar($value)) {
                continue;
            }
            $array[$property->getName()] = $value;
            $property->setAccessible(false);
        }
        return $array;
    }

}