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

namespace Chanshige\Hydrator;

use Chanshige\Hydrator\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Throwable;

final class ObjectHydrator implements ObjectHydratorInterface
{
    public function __construct(
        private Serializer $serializer
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($data, string $className)
    {
        try {
            return $this->serializer->denormalize($data, $className);
        } catch (Throwable $e) {
            throw new LogicException($e->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function extract(object|array $object): array
    {
        try {
            return (array)$this->serializer->normalize($object, null, [
                AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true,
                AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
            ]);
        } catch (Throwable $e) {
            throw new LogicException($e->getMessage());
        }
    }
}
