<?php

namespace App\Listener;

use App\Document\LogEntry;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class EntityChangingAuditor implements EventSubscriberInterface
{
    public function __construct(
        private readonly array               $listenedEntities,
        private readonly DocumentManager     $documentManager,
        private readonly Security            $security,
        private readonly SerializerInterface $serializer,
    )
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    public function __invoke(LifecycleEventArgs $args): void
    {
        $changedEntity = $args->getObject();
        $changedEntityClass = get_class($changedEntity);
        if (!in_array($changedEntityClass, $this->listenedEntities)) {
            return;
        }

        $logEntry = new LogEntry();
        $logEntry->setUserId($this->security->getUser()?->getUserIdentifier());
        $logEntry->setEntity($changedEntityClass);
        $logEntry->setEntityValue($this->serializer->serialize($changedEntity, 'json'));
        $logEntry->setDateTime(new \DateTimeImmutable());

        $auditRepository = $this->documentManager->getRepository(LogEntry::class);
        $auditRepository->save($logEntry, true);
    }
}