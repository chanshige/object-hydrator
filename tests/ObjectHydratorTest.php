<?php

declare(strict_types=1);

namespace Chanshige\Hydrator;

use Chanshige\Hydrator\Exception\LogicException;
use Chanshige\Hydrator\Fake\AuthorEntity;
use Chanshige\Hydrator\Fake\BlogEntity;
use PHPUnit\Framework\TestCase;

class ObjectHydratorTest extends TestCase
{
    protected ObjectHydratorInterface $hydrate;

    protected function setUp(): void
    {
        parent::setUp();
        $this->hydrate = (new ObjectHydratorFactory())->newInstance();
    }

    /**
     * @dataProvider authorDataProvider
     * @param array $data
     */
    public function testHydrate(array $data)
    {
        $object = $this->hydrate->hydrate($data, AuthorEntity::class);

        $this->assertInstanceOf(AuthorEntity::class, $object);
        $this->assertSame($data['id'], $object->getId());
    }

    /**
     * @dataProvider blogDataProvider
     * @param array $data
     */
    public function testHydrateWithInner(array $data)
    {
        $object = $this->hydrate->hydrate($data, AuthorEntity::class);

        $expected = new AuthorEntity(
            id: $data['id'],
            username: $data['username'],
            email: $data['email'],
            displayName: $data['display_name'],
            blog: new BlogEntity(
                id: $data['blog']['id'],
                title: $data['blog']['title'],
                contents: $data['blog']['contents']
            )
        );

        $this->assertInstanceOf(AuthorEntity::class, $object);
        $this->assertEquals($expected, $object);
    }

    public function testHydrateNullOrEmptyVal()
    {
        $data = [
            'id' => 777,
            'username' => null,
            'display_name' => '',
        ];

        $object = $this->hydrate->hydrate($data, AuthorEntity::class);

        $this->assertSame($data['id'], $object->getId());
        $this->assertSame($data['username'], $object->getUsername());
        $this->assertSame($data['display_name'], $object->getDisplayName());
    }

    public function testExtractNullOrEmptyVal()
    {
        $author = new AuthorEntity(id: $id = 10000, email: $email = 'email@email.example');

        $this->assertSame(compact('id', 'email'), $this->hydrate->extract($author));
    }

    /**
     * @dataProvider authorDataProvider
     * @param array $data
     */
    public function testExceptionHydrate(array $data)
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(
            'Could not denormalize object of type "App\Dummy", no supporting normalizer found.'
        );

        $this->hydrate->hydrate($data, 'App\Dummy');
    }

    /**
     * @return array
     */
    public function authorDataProvider(): array
    {
        return [
            [
                [
                    'id' => 1,
                    'username' => 'foo bar',
                    'email' => 'foo@bar.baz',
                    'display_name' => 'foo fighters.',
                ]
            ]
        ];
    }

    public function blogDataProvider(): array
    {
        return [
            [
                [
                    'id' => 200,
                    'username' => 'bar bar',
                    'email' => 'bar@bar.bar',
                    'display_name' => 'bar fighters.',
                    'blog' => [
                        'id' => 100,
                        'title' => 'first blog',
                        'contents' => 'Hi!'
                    ]
                ]
            ]
        ];
    }
}
