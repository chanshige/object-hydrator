<?php

namespace Chanshige\Hydration\Fake;

/**
 * Class DummyEntity
 *
 * @package Chanshige\Hydration\Fake
 */
class DummyEntity
{
    /** @var string|null */
    private $foo;

    /** @var string|null */
    private $bar;

    /** @var string|null */
    private $baz;

    /** @var string|null */
    private $qux;

    /** @var string|null */
    private $quux;

    /** @var object|null */
    private $entity;

    /**
     * @return string|null
     */
    public function getFoo(): ?string
    {
        return $this->foo;
    }

    /**
     * @param string|null $foo
     */
    public function setFoo(?string $foo): void
    {
        $this->foo = $foo;
    }

    /**
     * @return string|null
     */
    public function getBar(): ?string
    {
        return $this->bar;
    }

    /**
     * @param string|null $bar
     */
    public function setBar(?string $bar): void
    {
        $this->bar = $bar;
    }

    /**
     * @return string|null
     */
    public function getBaz(): ?string
    {
        return $this->baz;
    }

    /**
     * @param string|null $baz
     */
    public function setBaz(?string $baz): void
    {
        $this->baz = $baz;
    }

    /**
     * @return string|null
     */
    public function getQux(): ?string
    {
        return $this->qux;
    }

    /**
     * @param string|null $qux
     */
    public function setQux(?string $qux): void
    {
        $this->qux = $qux;
    }

    /**
     * @return string|null
     */
    public function getQuux(): ?string
    {
        return $this->quux;
    }

    /**
     * @param string|null $quux
     */
    public function setQuux(?string $quux): void
    {
        $this->quux = $quux;
    }

    /**
     * @return object|null
     */
    public function getEntity(): ?object
    {
        return $this->entity;
    }

    /**
     * @param object|null $entity
     */
    public function setEntity(?object $entity): void
    {
        $this->entity = $entity;
    }
}
