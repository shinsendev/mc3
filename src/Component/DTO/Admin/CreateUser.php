<?php


namespace App\Component\DTO\Admin;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUser
{
    /**
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     */
    public static function execute(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        // create an user with mc2@shinsen.fr email if it doesn't already exist
        if ($em->getRepository(User::class)->findOneByEmail(User::ADMIN_EMAIL)) {
            return;
        }

        $user = new User();
        $user->setEmail(User::ADMIN_EMAIL);
        $user->setUsername(User::ADMIN_NAME);
        $user->setPassword($encoder->encodePassword($user, $_ENV['ADMIN_PASSWORD']));
        $user->setRoles(['ROLE_ADMIN']);

        $em->persist($user);
        $em->flush();
    }
}