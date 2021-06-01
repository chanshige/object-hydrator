<?php

namespace Chanshige\Hydrator\Fake;

class AuthorEntity
{
    public function __construct(
        private int $id,
        private ?string $username = null,
        private ?string $email = null,
        private ?string $displayName = null,
        private ?BlogEntity $blog = null
    ) {}

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
