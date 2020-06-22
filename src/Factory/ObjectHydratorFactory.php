<?php

declare(strict_types=1);

namespace Chanshige\Hydration\Factory;

use Chanshige\Hydration\ObjectHydrator;
use Chanshige\Hydration\ObjectHydratorInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ObjectHydratorFactory
 *
 * @package Chanshige\Factory
 */
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
