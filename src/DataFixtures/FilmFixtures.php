<?php

namespace App\DataFixtures;

use App\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $film = new Film();
        $film->setTitle('West Side Story');
        $film->setUuid('5e110313-1f01-4f1e-8515-84c93fbb08ad');
        $manager->persist($film);

        $manager->flush();
    }
}
