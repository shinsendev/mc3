<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Film;
use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class FilmFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0;  $i <2; $i++) {
            $film = $this->generateFilm($i);
            $manager->persist($film);
        }

        $manager->flush();
    }

    /**
     * @param int $index
     * @return Film
     */
    public function generateFilm(int $index) :Film
    {
        $titles = ["West Side Story ", "The Jazz Singer"];
        $uuidList = ['18d2c4f3-e16b-4885-908c-46f7e2cd8e38', 'd863687a-7f74-4c45-a904-65480220ade1'];
        $lengths = [6000, 5288];
        $releasedYears = [1961,1927];
        $productionYears= [1962, 1928];
        $imdbIds = ['tt0055614', 'tt0018037'];
        $remakes = [false, true];
        $samples = [false, true];

        $film = new Film();
        $film->setTitle($titles[$index]);
        $film->setUuid($uuidList[$index]);
        $film->setLength($lengths[$index]);
        $film->setReleasedYear($releasedYears[$index]);
        $film->setProductionYear($productionYears[$index]);
        $film->setImdb($imdbIds[$index]);
        $film->setRemake($remakes[$index]);
        $film->setSample($samples[$index]);
        
        return $film;
    }

}