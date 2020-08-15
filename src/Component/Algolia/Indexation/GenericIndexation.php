<?php

declare(strict_types=1);


namespace App\Component\Algolia\Indexation;


use App\Component\Factory\DTOFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;

class GenericIndexation
{
    const INDEX_NAME = 'mc2';

    /**
     * @param EntityManagerInterface $em
     * @param Serializer $serializer
     * @param $client
     * @param OutputInterface $output
     * @param string $type
     * @param string $hydrator
     * @param string $dtoName
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public static function index(
        EntityManagerInterface $em,
        Serializer $serializer,
        $client, OutputInterface $output,
        string $type,
        string $hydrator,
        string $dtoName
    ):void
    {
        $output->writeln([
            ucfirst($type).'s indexation',
            '============',
            '',
        ]);

        $limit = 100;
        $offset = 0;
        $index = $client->initIndex(self::INDEX_NAME);

        $countFunctionName = 'count'.ucfirst($type).'s';
        $itemsCount = $em->getRepository('App\Entity\\'.ucfirst($type))->$countFunctionName();
        $turns = ceil($itemsCount / $limit);

        $progressBar = new ProgressBar($output, $itemsCount);

        for ($i = 0; $i < $turns; $i++) {
            $items = $em->getRepository('App\Entity\\'.ucfirst($type))->findBy([], [], $limit, $offset);

            foreach ($items as $item) {
                $itemDTO = DTOFactory::create($dtoName);
                $itemDTO = $hydrator::hydrate($itemDTO, [$type => $item], $em);

                $itemArray = $serializer->normalize($itemDTO);
                $itemArray['modelType'] = $type;
                $itemArray['objectID'] = $itemDTO->getUuid();
                $index->saveObject($itemArray);
                // for liberating some memory
                $item = null;
                $itemArray = null;
                $itemDTO = null;

                $progressBar->advance();
            }

            $offset += $limit;

            if ($limit > $itemsCount) {
                unset($items);
                $offset = $itemsCount;
            }

            // for liberating some memory
            $items = null;
        }

        $progressBar->finish();

        $output->writeln([
            '',
            '============',
            'End of '.$type.' indexation',
        ]);
    }
}