<?php

namespace App\Listener;

use App\Document\LogEntry;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;

class EntityChangingAuditor implements EventSubscriberInterface
{
    public function __construct(
        private readonly array $listenedEntities,
        private readonly DocumentManager $documentManager,
        private readonly Security $security
    )
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $changedEntity = $args->getObject();
        $changedEntityClass = get_class($changedEntity);
        if (!in_array($changedEntityClass, $this->listenedEntities)) {
            return;
        }

        $logEntry = new LogEntry();
        $logEntry->setUserId($this->security->getUser()?->getUserIdentifier());
        $logEntry->setEntity($changedEntityClass);
        $logEntry->setEntityValue('asd');

        $auditRepository = $this->documentManager->getRepository(LogEntry::class);
        $auditRepository->save($logEntry, true);
    }
}