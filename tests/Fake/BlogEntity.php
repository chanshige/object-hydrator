<?php

namespace Chanshige\Hydrator\Fake;

class BlogEntity
{
    public function __construct(
        private int $id,
        private ?string $title = null,
        private ?string $contents = null
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
}
