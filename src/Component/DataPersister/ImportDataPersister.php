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
        // when persist launch

        dd('last here after transformation and security for saving');
        //todo : launch import here
    }

    public function remove($data, array $context = [])
    {
        // no delete function
    }

}