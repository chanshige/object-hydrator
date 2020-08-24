<?php

/*
 * This file is part of the chanshige/object-hydrator package.
 *
 * (c) shigeki tanaka <dev@shigeki.tokyo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Chanshige\Hydration;

interface ObjectHydratorInterface
{
    /**
     * @param array<int|string, mixed> $data
     * @return object
     * @throws HydrationException
     */
    public function hydrate(array $data, string $className);

    /**
     * @param object[]|object $object
     * @return array<int|string, mixed>
     * @throws HydrationException
     */
    public function extract($object);
}
