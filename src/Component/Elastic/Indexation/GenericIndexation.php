<?php

declare(strict_types=1);


namespace App\Component\Elastic\Indexation;


use App\Component\Factory\DTOFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;

class GenericIndexation
{
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

        $countFunctionName = 'count'.ucfirst($type).'s';
        $itemsCount = $em->getRepository('App\Entity\\'.ucfirst($type))->$countFunctionName();
        $turns = ceil($itemsCount / $limit);

        $progressBar = new ProgressBar($output, $itemsCount);

        for ($i = 0; $i < $turns; $i++) {
            $items = $em->getRepository('App\Entity\\'.ucfirst($type))->findBy([], [], $limit, $offset);

            foreach ($items as $item) {
                $itemDTO = DTOFactory::create($dtoName);
                $itemDTO = $hydrator::hydrate($itemDTO, [$type => $item], $em);

                $jsonContent = $serializer->serialize($itemDTO, 'json');
                $itemsArray = json_decode($jsonContent);

                $params['body']  = $itemsArray;
                $params['index'] = $type;
                $params['type']  = $type;
                $params['id']    = $item->getUuid();

                $client->index($params);
                $progressBar->advance();
            }

            $offset += $limit;

            if ($limit > $itemsCount) {
                unset($items);
                $offset = $itemsCount;
            }
        }

        $progressBar->finish();

        $output->writeln([
            '',
            '============',
            'End of '.$type.' indexation',
        ]);
    }
}
