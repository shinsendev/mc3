<?php

declare(strict_types=1);


namespace App\Component\Algolia\Indexation;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;

interface IndexationInterface
{
    public static function index(EntityManagerInterface $em, Serializer $serializer, $client, OutputInterface $output);
}