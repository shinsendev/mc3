<?php

namespace App\Command;

use App\Component\DTO\Admin\CreateUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminCreateUserCommand extends Command
{
    protected static $defaultName = 'admin:create';

    private EntityManagerInterface $em;
    private UserPasswordEncoderInterface $encoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->encoder = $encoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a first activated user for the administration')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        CreateUser::execute($this->em, $this->encoder);
        $io->success("User has been created if it hasn't already exist");

        return 0;
    }
}
