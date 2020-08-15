<?php

namespace App\Command;

use App\Entity\Indexation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IndexationUpdateCommand extends Command
{
    protected static $defaultName = 'indexation:update';

    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Change in progress to false for the last indexation and update last_update')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->em->getRepository(Indexation::class)->updateLastIndexation($this->em->getRepository(Indexation::class)->getLastIndexation());
        $io->success('Last indexation in progress has been changed to false if it was true.');

        return 0;
    }
}
