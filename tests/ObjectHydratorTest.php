<?php

namespace Chanshige\Hydration;

use Chanshige\Hydration\Factory\ObjectHydratorFactory;
use Chanshige\Hydration\Fake\DummyEntity;
use PHPUnit\Framework\TestCase;

/**
 * Class ObjectHydratorTest
 *
 * @package Chanshige\Hydration
 */
class ObjectHydratorTest extends TestCase
{
    protected $hydration;

    protected function setUp()
    {
        $this->hydration = (new ObjectHydratorFactory())->newHydrator();
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     */
    public function testHydrate(array $data)
    {
        $object = $this->hydration->hydrate($data, DummyEntity::class);

        $this->assertInstanceOf(DummyEntity::class, $object);
        $this->assertSame($data['foo'], $object->getFoo());
        $this->assertSame($data['bar'], $object->getBar());
        $this->assertSame($data['baz'], $object->getBaz());
        $this->assertSame($data['qux'], $object->getBaz());
        $this->assertSame($data['quux'], $object->getBaz());
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     */
    public function testExtract(array $data)
    {
        unset($data['baz'], $data['quux']);

        $object = new DummyEntity();
        $object->setFoo($data['foo']);
        $object->setBar($data['bar']);
        $object->setQux($data['qux']);

        $this->assertSame($data, $this->hydration->extract($object));
    }

    public function testExtractMaxDepth()
    {
        $data = [
            'baz' => 'baz_value1',
            'qux' => 'baz_value1',
            'quux' => 'baz_value1',
            'entity' => [
                'foo' => 'foo_value1',
                'bar' => 'bar_value1',
            ]
        ];

        $object = new DummyEntity();
        $object->setBaz($data['baz']);
        $object->setQux($data['qux']);
        $object->setQuux($data['quux']);

        $object1 = new DummyEntity();
        $object1->setFoo($data['entity']['foo']);
        $object1->setBar($data['entity']['bar']);

        $object->setEntity($object1);

        $this->assertSame($data, $this->hydration->extract($object));
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     */
    public function testExceptionHydrate(array $data)
    {
        $this->expectException(HydrationException::class);
        $this->expectExceptionMessage('Could not denormalize object of type "App\Dummy", no supporting normalizer found.');

        $this->hydration->hydrate($data, 'App\Dummy');
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                [
                    'foo' => 'foo_value1',
                    'bar' => 'bar_value1',
                    'baz' => 'baz_value1',
                    'qux' => 'baz_value1',
                    'quux' => 'baz_value1',
                ]
            ]
        ];
    }
}
