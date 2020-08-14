<?php

namespace App\Command;

use App\Component\DTO\Admin\DeleteUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminDeleteCommand extends Command
{
    protected static $defaultName = 'admin:delete';

    private EntityManagerInterface $em;

    /**
     * AdminCreateUserCommand constructor.
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->encoder = $encoder;
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
