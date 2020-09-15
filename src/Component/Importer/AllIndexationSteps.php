<?php


namespace App\Component\Importer;


use App\Component\Algolia\Indexation\Indexer as AlgoliaIndexer;
use App\Component\Stats\StatsGenerator;
use App\Entity\Attribute;
use App\Entity\Indexation;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Component\Elastic\Indexation\Indexer as ElasticIndexer;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AllIndexationSteps
{
    public static function execute(EntityManagerInterface $em, LoggerInterface $logger, OutputInterface $output, HttpClientInterface $client)
    {
        // compute stats
        $logger->info('Stats for people starts to be computed.');
        $people = $em->getRepository(Person::class)->findAll();

        foreach ($people as $person) {
            StatsGenerator::generate(StatsGenerator::PERSON_STRATEGY, $person->getUuid(), $em);
            $logger->info('Stats have been computed for '.$person->getUuid().'\n');
            $person = null;
        }
        $logger->info('Stats for people have been successfully completed.');
        $people = null;

        $logger->info('Stats for attributes starts to be computed.');
        $attributes = $em->getRepository(Attribute::class)->findAll();
        foreach ($attributes as $attribute) {
            $options['model'] = $attribute->getCategory()->getModel();;
            StatsGenerator::generate(StatsGenerator::ATTRIBUTE_STRATEGY, $attribute->getUuid(), $em, $options);
            $logger->info('Stats have been computed for '.$attribute->getUuid().'\n');
        }
        $logger->info('Stats for attributes have been successfully completed.');
        $attributes = null;

        // indexation
        self::index($em, $logger, $output);

        // update Indexation entity when process is finished
        $em->getRepository(Indexation::class)->updateLastIndexation($em->getRepository(Indexation::class)->getLastIndexation());
        $logger->info('Indexation is complete.');

        // rebuild website with a netlify hook https://docs.netlify.com/configure-builds/build-hooks/
        $client->request(
            'POST',
            'https://api.netlify.com/build_hooks/'.$_SERVER['NETLIFY_KEY']
        );
    }

    private static function index(EntityManagerInterface $em, LoggerInterface $logger, OutputInterface $output) {
        // for bonsai exception at exact hours, we can change the order of the indexation
        $now = new \Datetime();
        $formatedNow = $now->format("Y-m-d H:i:s");
        $strtotime = strtotime($formatedNow);
        $minutes = date('i', $strtotime);

        // if it is an exact hours we begin to index algolia
        if ($minutes === 00) {
            // reindex algolia
            $logger->info('Algolia indexation has begun.');
            AlgoliaIndexer::populate($em, $output);

            // reindex elastic search
            $logger->info('Bonsai indexation has begun.');
            ElasticIndexer::populate($em, $output);
        }
        else {
            // reindex elastic search
            $logger->info('Bonsai indexation has begun.');
            ElasticIndexer::populate($em, $output);

            // reindex algolia
            $logger->info('Algolia indexation has begun.');
            AlgoliaIndexer::populate($em, $output);
        }
    }

}