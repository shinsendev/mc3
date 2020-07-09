<?php

namespace App\Command;

use App\Component\Elastic\Indexation\Indexer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ElasticIndexCreateCommand
 * @package App\Command
 */
class ElasticIndexDeleteCommand extends Command
{
    protected static $defaultName = 'elastic:delete';

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
            ->setDescription('Create indexes for Elastic');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        Indexer::delete($this->em, $output);

        $io->success('Indexes has been deleted.');

        return 0;
    }
}
