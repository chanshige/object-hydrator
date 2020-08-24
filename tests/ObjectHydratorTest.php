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
        $this->assertSame($data['qux'], $object->getQux());
        $this->assertSame($data['quux'], $object->getQuux());
        $this->assertSame($data['bar_baz'], $object->getBarBaz());
    }

    public function testHydrateNullOrEmptyVal()
    {
        $data = [
            'baz' => null,
            'qux' => '',
        ];

        $object = $this->hydration->hydrate($data, DummyEntity::class);
        $this->assertInstanceOf(DummyEntity::class, $object);
        $this->assertSame($data['baz'], $object->getBaz());
        $this->assertSame($data['qux'], $object->getQux());
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
        $object->setBarBaz($data['bar_baz']);

        $this->assertSame($data, $this->hydration->extract($object));
    }

    public function testExtractNullOrEmptyVal()
    {
        $data = [
            'baz' => null,
            'qux' => '',
            'entity' => [
                'baz' => '',
                'qux' => null,
            ]
        ];
        $object = new DummyEntity();
        $object->setBaz($data['baz']);
        $object->setQux($data['qux']);

        $object1 = new DummyEntity();
        $object1->setBaz($data['entity']['baz']);
        $object1->setQux($data['entity']['qux']);

        $object->setEntity($object1);

        unset($data['baz'], $data['entity']['qux']);

        $this->assertSame($data, $this->hydration->extract($object));
    }

    public function testExtractMaxDepth()
    {
        $data = [
            'baz' => 'baz_value',
            'qux' => 'qux_value',
            'quux' => 'quux_value',
            'entity' => [
                'foo' => 'foo_value',
                'bar' => 'bar_value',
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

    public function testExtractMaxDepthForArray()
    {
        $object = new DummyEntity();
        $object->setBaz('123');
        $object->setQux('456');
        $object->setQuux('789');

        $expected = [
            [
                'baz' => '123',
                'qux' => '456',
                'quux' => '789'
            ],
            [
                'baz' => '123',
                'qux' => '456',
                'quux' => '789'
            ],
            [
                'baz' => '123',
                'qux' => '456',
                'quux' => '789'
            ]
        ];

        $this->assertSame(
            $expected,
            $this->hydration->extract(
                [
                    $object,
                    $object,
                    $object,
                ]
            )
        );
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     */
    public function testExceptionHydrate(array $data)
    {
        $this->expectException(HydrationException::class);
        $this->expectExceptionMessage(
            'Could not denormalize object of type "App\Dummy", no supporting normalizer found.'
        );

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
                    'foo' => 'foo_value',
                    'bar' => 'bar_value',
                    'baz' => 'baz_value',
                    'qux' => 'qux_value',
                    'quux' => 'quux_value',
                    'bar_baz' => 'bar_baz_value',
                ]
            ]
        ];
    }
}
