<?php

namespace Chanshige\Hydration;

/**
 * Interface ObjectHydratorInterface
 *
 * @package Chanshige
 */
interface ObjectHydratorInterface
{
    /**
     * @param array  $data
     * @param string $className
     * @return object
     * @throws HydrationException
     */
    public function hydrate(array $data, string $className);

    /**
     * @param object $object single object.
     * @return array
     * @throws HydrationException
     */
    public function extract(object $object);
}
