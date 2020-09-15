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

namespace Chanshige\Hydration;

use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Throwable;

final class ObjectHydrator implements ObjectHydratorInterface
{
    /** @var Serializer */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($data, string $className)
    {
        try {
            return $this->serializer->denormalize($data, $className, null);
        } catch (Throwable $e) {
            throw new HydrationException($e->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function extract($object)
    {
        try {
            return (array)$this->serializer->normalize($object, null, [
                AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true,
                AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
            ]);
        } catch (Throwable $e) {
            throw new HydrationException($e->getMessage());
        }
    }
}
