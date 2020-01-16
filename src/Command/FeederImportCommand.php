<?php

namespace App\Command;

use App\Component\Feeder\Feeder;
use App\Component\Feeder\FeederObserver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FeederImportCommand extends Command
{
    protected static $defaultName = 'feeder:import';

    /** @var EntityManagerInterface */
    private $em;

    /** @var FeederObserver */
    private $observer;

    /**
     * FeederImportCommand constructor.
     * @param EntityManagerInterface $em
     * @param FeederObserver $observer
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, FeederObserver $observer, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->observer = $observer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Import data from a file into database')
            ->addArgument('file', InputArgument::REQUIRED, 'The path and the name of the file to import')
            ->addArgument('entity', InputArgument::REQUIRED, 'The entity to import')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $file = $input->getArgument('file');
        $entity = 'App\Entity\\'.ucfirst($input->getArgument('entity'));
        $repository = $this->em->getRepository($entity);

        Feeder::run($this->em, $file, $repository, $this->observer);

        $io->success('Import succeeds');

        return 0;
    }
}
