<?php

declare(strict_types=1);


namespace App\DataFixtures;


use App\Entity\Film;
use App\Entity\Number;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

class NumberFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var Generator */
    protected $faker;

    public function getData()
    {
        return [
            ['title'=> 'Overture', 'uuid' => '5d5bee4b-3fab-4c65-b045-9b116b218d4c', 'beginTc' => 22, 'endTc' => 301],
            ['title'=> 'Prologue', 'uuid' => 'ec1b17fd-1578-4c69-a52a-094bf4c7b078', 'reference' => 'References example'],
            ['title'=> 'Jet Song'],
            ['title'=> 'Something\'s Coming'],
            ['title'=> 'Dance at the Gym: Blues'],
            ['title'=> 'Dance at the Gym: Mambo'],
            ['title'=> 'Cha-Cha'],
            ['title'=> 'Maria'],
        ];
    }

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        $filmRepository = $manager->getRepository(Film::class);
        $film = $filmRepository->findOneByUuid('18d2c4f3-e16b-4885-908c-46f7e2cd8e38');

        foreach ($this->getData() as $numberData) {
            $number = $this->generateNumber($numberData, $manager);
            $number->setFilm($film);
            $manager->persist($number);
        }

        $manager->flush();
    }

    public function generateNumber(array $data, ObjectManager $manager)
    {
        $number = new Number();
        $number->setTitle($data['title']);

        isset($data['uuid']) ? $uuid = $data['uuid'] : $uuid = Uuid::uuid4();
        $number->setUuid($uuid);

        isset($data['beginTc']) ? $beginTc = $data['beginTc'] : $beginTc = 0;
        $number->setBeginTc($beginTc);

        isset($data['endTc']) ? $endTc = $data['endTc'] : $endTc = 10;
        $number->setEndTc($endTc);

        isset($data['reference']) ? $reference = $data['reference'] : $reference = 0;
        $number->setReference($reference);

        $number->setShots(0);
        $number->setContributors(null);

        return $number;
    }

    public function getDependencies()
    {
        return array(
            FilmFixtures::class,
        );
    }
}