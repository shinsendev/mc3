<?php

namespace App\Component\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Import;

class ImportDataPersister implements ContextAwareDataPersisterInterface
{
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Import;
    }

    public function persist($data, array $context = [])
    {
        //todo : launch import here
    }

    public function remove($data, array $context = [])
    {
        // no delete function
    }

}