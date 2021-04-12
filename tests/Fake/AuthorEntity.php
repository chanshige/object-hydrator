<?php

namespace Chanshige\Hydrator\Fake;

use DateTimeInterface;

class AuthorEntity
{
    /** @var int */
    private $id;

    /** @var string|null */
    private $username;

    /** @var string|null */
    private $email;

    /** @var string|null */
    private $displayName;

    /** @var BlogEntity|null */
    private $blog;

    public function __construct(
        int $id,
        ?string $username = null,
        ?string $email = null,
        ?string $displayName = null,
        ?BlogEntity $blog = null
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->displayName = $displayName;
        $this->blog = $blog;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function getBlog(): ?BlogEntity
    {
        return $this->blog;
    }
}
