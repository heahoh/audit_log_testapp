<?php

namespace App\Repository;

use App\Entity\LogEntry;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class LogEntryRepository extends DocumentRepository
{
    public function save(LogEntry $entity, bool $flush = false): void
    {
        $this->getDocumentManager()->persist($entity);

        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }

    public function remove(LogEntry $entity, bool $flush = false): void
    {
        $this->getDocumentManager()->remove($entity);

        if ($flush) {
            $this->getDocumentManager()->flush();
        }
    }
}
