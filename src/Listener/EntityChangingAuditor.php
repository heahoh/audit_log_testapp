<?php

namespace App\Listener;

use App\Repository\LogEntryRepository;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntityChangingAuditor implements EventSubscriberInterface
{
    private array $listenedEntities;
    private LogEntryRepository $logEntryRepository;

    public function __construct(array $listenedEntities, LogEntryRepository $logEntryRepository)
    {
        $this->listenedEntities = $listenedEntities;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {

    }
}