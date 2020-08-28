<?php

namespace App\Command;

use App\Component\Error\Mc3Error;
use App\Component\Model\ModelConstants;
use App\Component\Stats\StatsGenerator;
use App\Entity\Attribute;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatsAttributeUpdateCommand extends Command
{
    protected static $defaultName = 'stats:attribute:update';

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->addArgument('attributeUuid', InputArgument::OPTIONAL, 'Optional : the uuid of the attribute you will update')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $message = $this->handle($input, $output, ModelConstants::ATTRIBUTE_MODEL, StatsGenerator::ATTRIBUTE_STRATEGY, $this->em->getRepository(Attribute::class));
        $io->success($message);

        return 0;
    }

    private function handle($input, $output, string $model, $strategy, $repository):string
    {
        // if there is a uuid, we only update ONE attribute stats
        if ($elementUuid = $input->getArgument('attributeUuid')) {
            if (!$element = $repository->findOneByUuid($elementUuid)) {
                throw new Mc3Error('No '.$model.' with uuid '.$elementUuid.' has been found.');
            }

            $output->writeln([
                'Generate Stats for '.$model.' '.$elementUuid,
            ]);

            StatsGenerator::generate($strategy, $elementUuid, $this->em);

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
                StatsGenerator::generate($strategy, $element->getUuid(), $this->em);
                $progressBar->advance();
            }

            $progressBar->finish();
            $message = 'All '.$model.'s stats have been updated';
        }

        return $message;
    }
}
