<?php


namespace App\Component\DTO\Admin;

use App\Component\Error\Mc3Error;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class DeleteUser
{
    /**
     * @param EntityManagerInterface $em
     */
    public static function execute(EntityManagerInterface $em)
    {
        if (!$user = $em->getRepository(User::class)->findOneByEmail(User::ADMIN_EMAIL)) {
            throw new Mc3Error('No user found with email '.User::ADMIN_EMAIL);
        }

        $em->remove($user);
        $em->flush();
    }
}