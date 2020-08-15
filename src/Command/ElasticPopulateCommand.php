<?php

namespace App\Command;

use App\Component\Elastic\Indexation\Indexer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ElasticPopulateCommand
 * @package App\Command
 */
class ElasticPopulateCommand extends Command
{
    protected static $defaultName = 'elastic:populate';

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
            ->setDescription('Index all items for Elastic Search')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        Indexer::populate($this->em, $output);
        $io->success('Indexation is ok');

        return 0;
    }
}
