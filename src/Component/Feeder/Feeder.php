<?php

namespace App\Component\Feeder;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class Feeder
{
    /**
     * @param EntityManagerInterface $em
     * @param string $file
     * @param ObjectRepository $repository
     * @param FeederObserver $observer
     * @return JsonResponse
     */
    public static function run(
        EntityManagerInterface $em,
        string $file,
        ObjectRepository $repository,
        FeederObserver $observer
    )
    {
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                Line::save($em, $data, $observer);
            }
            fclose($handle);
        }
        return new JsonResponse('Data saved');
    }
}