<?php

declare(strict_types=1);


namespace App\Component\Algolia\Indexation;

use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\FilmPayloadHydrator;
use App\Component\Hydrator\Strategy\NumberPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use Elasticsearch\Client;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class NumberIndexation
 * @package App\Component\Algolia\Indexation
 */
class NumberIndexation implements IndexationInterface
{
    public static function index(EntityManagerInterface $em, Serializer $serializer, $client, OutputInterface $output)
    {
        GenericIndexation::index($em, $serializer, $client, $output, ModelConstants::NUMBER_MODEL, NumberPayloadHydrator::class, ModelConstants::NUMBER_PAYLOAD_MODEL);
    }
}