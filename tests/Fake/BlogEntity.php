<?php

namespace Chanshige\Hydrator\Fake;

use DateTimeInterface;

class BlogEntity
{
    public function __construct(
        private int $id,
        private ?string $title = null,
        private ?string $contents = null,
        private ?DateTimeInterface $created = null
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getContents(): ?string
    {
        return $this->contents;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }
}
