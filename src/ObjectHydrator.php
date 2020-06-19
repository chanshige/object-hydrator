<?php

declare(strict_types=1);

namespace Chanshige\Hydration;

use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Throwable;

/**
 * Class ObjectHydrator
 *
 * @package Chanshige
 */
final class ObjectHydrator implements ObjectHydratorInterface
{
    /** @var Serializer */
    private $serializer;

    /**
     * ObjectHydrator constructor.
     *
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate(array $data, string $className)
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
    public function extract(object $object)
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
