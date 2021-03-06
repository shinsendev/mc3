<?php

declare(strict_types=1);


namespace App\Component\Elastic\Indexation;

use App\Component\Hydrator\Strategy\Elastic\ElasticNumberHydratorAbstract;
use App\Component\Model\ModelConstants;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class NumberIndexation
 * @package App\Component\Elastic\Indexation
 */
class NumberIndexation
{
    public static function index(EntityManagerInterface $em, Serializer $serializer, $client, OutputInterface $output):void
    {
        GenericIndexation::index(
            $em,
            $serializer,
            $client,
            $output,
            ModelConstants::NUMBER_MODEL,
            ElasticNumberHydratorAbstract::class,
            ModelConstants::ELASTIC_NUMBER_DTO);
    }
}