<?php

namespace App\Document;

use App\Repository\LogEntryRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document(repositoryClass: LogEntryRepository::class)]
class LogEntry
{
    #[MongoDB\Id]
    private ?string $id = null;

    #[MongoDB\Field(type: 'string')]
    private ?string $user_id = null;

    #[MongoDB\Field(type: 'string')]
    private ?string $entity = null;

    #[MongoDB\Field(type: 'string')]
    private ?string $entity_value = null;

    #[MongoDB\Field(type: 'date_immutable')]
    private ?\DateTimeImmutable $date_time = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->user_id;
    }

    public function setUserId(?string $user_id): self
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

    public function setDateTime(\DateTimeImmutable $dateTime): self
    {
        $this->date_time = $dateTime;

        return $this;
    }
}
