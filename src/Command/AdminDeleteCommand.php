<?php

namespace App\Command;

use App\Component\DTO\Admin\DeleteUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AdminDeleteCommand extends Command
{
    protected static $defaultName = 'admin:delete';

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
            ->setDescription('Delete the admin activated user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        DeleteUser::execute($this->em);
        $io->success('Admin user has been deleted');

        return 0;
    }
}
