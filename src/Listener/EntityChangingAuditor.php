<?php

namespace App\Listener;

use App\Document\LogEntry;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntityChangingAuditor implements EventSubscriberInterface
{
    private array $listenedEntities;
    private DocumentManager $documentManager;

    public function __construct(array $listenedEntities, DocumentManager $documentManager)
    {
        $this->listenedEntities = $listenedEntities;
        $this->documentManager = $documentManager;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $repo = $this->documentManager->getRepository(LogEntry::class);
    }
}