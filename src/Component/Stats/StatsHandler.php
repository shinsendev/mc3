<?php


namespace App\Component\Stats;


use App\Component\Error\Mc3Error;
use App\Component\Model\ModelConstants;
use App\Entity\Definition\EntityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StatsHandler
{
    public static function handle(
        InputInterface $input,
        OutputInterface $output,
        string $model,
        string $strategy,
        ServiceEntityRepositoryInterface $repository,
        EntityManagerInterface $em
    ):string
    {
        $options = [];

        // if there is a uuid, we only update ONE attribute stats
        if ($elementUuid = $input->getArgument('elementUuid')) {
            if (!$element = $repository->findOneByUuid($elementUuid)) {
                throw new Mc3Error('No '.$model.' with uuid '.$elementUuid.' has been found.');
            }

            $output->writeln([
                'Generate Stats for '.$model.' '.$elementUuid,
            ]);

            $options = self::addOptions($options, $model, $element);
            StatsGenerator::generate($strategy, $elementUuid, $em, $options);

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
                $options = self::addOptions($options, $model, $element);
                StatsGenerator::generate($strategy, $element->getUuid(), $em, $options);
                $progressBar->advance();
            }

            $progressBar->finish();
            $message = 'All '.$model.'s stats have been updated';
        }

        return $message;
    }

    public static function addOptions(array $options, string $model, EntityInterface $element):array
    {
        if ($model === ModelConstants::ATTRIBUTE_MODEL) {
            $options['model'] = $element->getCategory()->getModel();
        }

        return $options;
    }
}