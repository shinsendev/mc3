<?php

namespace App\Command;

use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->addArgument('personUuid', InputArgument::OPTIONAL, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);


        // if there is a uuid, we only update one person stats
        if ($personUuid = $input->getArgument('personUuid')) {
            $person = $this->em->getRepository(Person::class)->findOneByUuid($personUuid);
            // add stats to
            // StatsGenerator->generate($person, Person)
            dd($personUuid);
        }

        // we compute the stats, create dto and convert in json file and save or update the stats
        else {
            $persons = $this->em->getRepository(Person::class)->findAll();

            foreach ($persons as $person) {
                // add stats to one person
            }
            // get person by 100
        }



        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
