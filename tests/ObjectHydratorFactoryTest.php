<?php

declare(strict_types=1);

namespace Chanshige\Hydrator;

use PHPUnit\Framework\TestCase;

class ObjectHydratorFactoryTest extends TestCase
{
    public function testObjectHydratorFactory()
    {
        $factory = new ObjectHydratorFactory();
        $this->assertInstanceOf(ObjectHydratorInterface::class, $factory->newInstance());
        $this->assertInstanceOf(ObjectHydrator::class, $factory->newInstance());
    }
}
