<?php


namespace App\Component\DTO\Admin;


use App\Component\Error\Mc3Error;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChangePasword
{
    public static function execute(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, string $password)
    {
        if (!$user = $em->getRepository(User::class)->findOneByEmail(User::ADMIN_EMAIL)) {
            throw new Mc3Error('No user found with email '.User::ADMIN_EMAIL);
        }

        $user->setPassword($encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();
    }
}