<?php

namespace Chanshige\Hydrator\Fake;

class BlogEntity
{
    /** @var int $id */
    private $id;

    /** @var string|null $title */
    private $title;

    /** @var string|null $contents */
    private $contents;

    public function __construct(
        int $id,
        ?string $title = null,
        ?string $contents = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->contents = $contents;
    }

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
