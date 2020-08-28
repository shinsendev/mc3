<?php


namespace App\Component\Importer;


use App\Component\Algolia\Indexation\Indexer as AlgoliaIndexer;
use App\Component\Error\Mc3Error;
use App\Component\Stats\StatsGenerator;
use App\Component\Stats\StatsHandler;
use App\Entity\Attribute;
use App\Entity\Import;
use App\Entity\Indexation;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Component\Elastic\Indexation\Indexer as ElasticIndexer;
use Symfony\Component\Console\Output\Output;

class AllIndexationSteps
{
    public static function execute(EntityManagerInterface $em, LoggerInterface $logger, Output $output)
    {
        // reindex elastic search
        $logger->info('Bonsai indexation has begun.');
        ElasticIndexer::populate($em, $output);

        // compute stats
        $logger->info('Stats for people starts to be computed.');
        $people = $em->getRepository(Person::class)->findAll();

        foreach ($people as $person) {
            StatsGenerator::generate(StatsGenerator::PERSON_STRATEGY, $person->getUuid(), $em);
            $logger->info('Stats have been computed for '.$person->getUuid().'\n');
        }
        $logger->info('Stats for people have been successfully completed.');

        $logger->info('Stats for attributes starts to be computed.');
        $attributes = $em->getRepository(Attribute::class)->findAll();
        foreach ($attributes as $attribute) {
            $options['model'] = $attribute->getCategory()->getModel();;
            StatsGenerator::generate(StatsGenerator::ATTRIBUTE_STRATEGY, $attribute->getUuid(), $em, $options);
            $logger->info('Stats have been computed for '.$attribute->getUuid().'\n');
        }
        $logger->info('Stats for attributes have been successfully completed.');

        // reindex algolia
        $logger->info('Algolia indexation has begun.');
        AlgoliaIndexer::populate($em, $output);

        // update Indexation entity when process is finished
        $em->getRepository(Indexation::class)->updateLastIndexation($em->getRepository(Indexation::class)->getLastIndexation());
        $logger->info('Indexation is complete.');
    }

}