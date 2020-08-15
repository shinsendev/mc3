<?php

namespace App\Command;

use App\Component\Error\Mc3Error;
use App\Component\Stats\StatsGenerator;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatsPersonUpdateCommand extends Command
{
    protected static $defaultName = 'stats:person:update';

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
            ->setDescription('Update stats for Person, if you add a person uuid, update only one person')
            ->addArgument('personUuid', InputArgument::OPTIONAL, 'Optional : the uuid of the person you will update')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // if there is a uuid, we only update ONE person stats
        if ($personUuid = $input->getArgument('personUuid')) {
            if (!$person = $this->em->getRepository(Person::class)->findOneByUuid($personUuid)) {
               throw new Mc3Error('No person with uuid '.$personUuid.' has been found.');
            }

            $output->writeln([
                'Generate Stats for person '.$personUuid,
            ]);

            StatsGenerator::generate(StatsGenerator::PERSON_STRATEGY, $personUuid, $this->em);

            $message = 'Stats for Person '.$person->getUuid()." has been updated.";
        }

        // if we don't have a specific uuid, we update ALL persons
        else {
            // todo : use doctrine pagination 100 by 100

            $persons = $this->em->getRepository(Person::class)->findAll();
            $personsCount = count($persons);
            $progressBar = new ProgressBar($output, $personsCount);

            $output->writeln([
                'Generate Stats for all persons.',
            ]);

            foreach ($persons as $person) {
                StatsGenerator::generate(StatsGenerator::PERSON_STRATEGY, $person->getUuid(), $this->em);
                $progressBar->advance();
            }

            $progressBar->finish();
            $message = 'All persons stats have been updated';
        }

        $io->success($message);

        return 0;
    }
}
