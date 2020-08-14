<?php

namespace App\Command;

use App\Component\DTO\Admin\ChangePasword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminPasswordCommand extends Command
{
    protected static $defaultName = 'admin:password';

    private EntityManagerInterface $em;
    private UserPasswordEncoderInterface $encoder;

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
            ->setDescription('Change the admin password')
            ->addArgument('newPassword', InputArgument::REQUIRED, 'The new password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $password = $input->getArgument('newPassword');
        ChangePasword::execute($this->em, $this->encoder, $password);
        $io->success('Admin password has been changed.');

        return 0;
    }
}
