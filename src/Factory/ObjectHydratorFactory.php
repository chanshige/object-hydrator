<?php

/*
 * This file is part of the chanshige/object-hydrator package.
 *
 * (c) shigeki tanaka <dev@shigeki.tokyo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Chanshige\Hydration\Factory;

use Chanshige\Hydration\ObjectHydrator;
use Chanshige\Hydration\ObjectHydratorInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class ObjectHydratorFactory
{
    /**
     * @return ObjectHydratorInterface
     */
    public function newHydrator(): ObjectHydratorInterface
    {
        return new ObjectHydrator(
            new Serializer(
                [
                    new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())
                ]
            )
        );
    }
}
