<?php

declare(strict_types=1);


namespace App\Component\Algolia\Indexation;

use App\Component\Hydrator\Strategy\PersonPayloadHydrator;
use App\Component\Model\ModelConstants;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;

class PersonIndexation implements IndexationInterface
{
    public static function index(EntityManagerInterface $em, Serializer $serializer, $client, OutputInterface $output)
    {
        GenericIndexation::index($em, $serializer, $client, $output, ModelConstants::PERSON_MODEL, PersonPayloadHydrator::class, ModelConstants::PERSON_PAYLOAD_MODEL);
    }
}