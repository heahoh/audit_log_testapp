<?php

namespace App\Document;

use App\Repository\LogEntryRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document(repositoryClass: LogEntryRepository::class)]
class LogEntry
{
    #[MongoDB\Id]
    private ?int $id = null;

    #[MongoDB\Field(type: 'int')]
    private ?int $user_id = null;

    #[MongoDB\Field(type: 'string')]
    private ?string $entity = null;

    #[MongoDB\Field(type: 'string')]
    private ?string $entity_value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getEntityValue(): ?string
    {
        return $this->entity_value;
    }

    public function setEntityValue(string $entity_value): self
    {
        $this->entity_value = $entity_value;

        return $this;
    }
}
