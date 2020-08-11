<?php


namespace App\Component\DTO\Admin;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUser
{
    const adminEmail = 'mc2@shinsen.fr';
    const username = 'mc2';

    /**
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     */
    public static function execute(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        // create an user with mc2@shinsen.fr email if it doesn't already exist
        if ($em->getRepository(User::class)->findOneByEmail(self::adminEmail)) {
            return;
        }

        $user = new User();
        $user->setEmail(self::adminEmail);
        $user->setUsername(self::username);
        $user->setPassword($encoder->encodePassword($user, $_ENV['ADMIN_PASSWORD']));
        $user->setActive(true);

        $em->persist($user);
        $em->flush();
    }
}