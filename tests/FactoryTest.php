<?php

declare(strict_types=1);

namespace Chanshige\Hydration;

use Chanshige\Hydration\Factory\ObjectHydratorFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class FactoryTest
 *
 * @package Chanshige\Hydration
 */
class FactoryTest extends TestCase
{
    public function testObjectHydratorFactory()
    {
        $factory = new ObjectHydratorFactory();
        $this->assertInstanceOf(ObjectHydratorInterface::class, $factory->newHydrator());
        $this->assertInstanceOf(ObjectHydrator::class, $factory->newHydrator());
    }
}
