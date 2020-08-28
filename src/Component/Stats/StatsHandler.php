<?php


namespace App\Component\Stats;


use App\Component\Error\Mc3Error;
use App\Component\Stats\Definition\StatsStrategyInteface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StatsHandler
{
    public static function handle(InputInterface $input, OutputInterface $output, string $model, string $strategy, ServiceEntityRepositoryInterface $repository, EntityManagerInterface $em):string
    {
        // if there is a uuid, we only update ONE attribute stats
        if ($elementUuid = $input->getArgument('attributeUuid')) {
            if (!$element = $repository->findOneByUuid($elementUuid)) {
                throw new Mc3Error('No '.$model.' with uuid '.$elementUuid.' has been found.');
            }

            $output->writeln([
                'Generate Stats for '.$model.' '.$elementUuid,
            ]);

            StatsGenerator::generate($strategy, $elementUuid, $em);

            $message = 'Stats for '.$model.' '.$element->getUuid()." has been updated.";
        }

        // if we don't have a specific uuid, we update ALL persons
        else {
            // todo : use doctrine pagination 100 by 100
            $elements = $repository->findAll();
            $count = count($elements);
            $progressBar = new ProgressBar($output, $count);

            $output->writeln([
                'Generate Stats for all '.$model.'s.',
            ]);

            foreach ($elements as $element) {
                StatsGenerator::generate($strategy, $element->getUuid(), $em);
                $progressBar->advance();
            }

            $progressBar->finish();
            $message = 'All '.$model.'s stats have been updated';
        }

        return $message;
    }
}