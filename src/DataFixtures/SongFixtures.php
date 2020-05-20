<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SongFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0;  $i <10; $i++) {
            $song = $this->generateSong();
            $manager->persist($song);
        }

        $manager->flush();
    }

    /**
     * @return Song
     */
    public static function generateSong() :Song
    {
        $song = new Song();
        $song->setTitle('A Pretty Girl Is Like a Melody');
        $song->setYear(1919);
        $song->setUuid('f42bb9a6-09b2-44a8-a887-3f590b93cc03"');

        return $song;
    }

}