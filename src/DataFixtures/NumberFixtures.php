<?php

declare(strict_types=1);


namespace App\DataFixtures;

use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Person;
use App\Entity\Work;
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
            ['title'=> 'Overture', 'uuid' => '5d5bee4b-3fab-4c65-b045-9b116b218d4c', 'beginTc' => 22, 'endTc' => 301, 'performers' => ['Astaire'], 'shots' => 12],
            ['title'=> 'Prologue', 'uuid' => 'ec1b17fd-1578-4c69-a52a-094bf4c7b078', 'spectators' => 'no', 'attributes' => ['475a4966-bc8b-46e0-b0de-8faad3f8dc62'], 'performers' => ['Astaire'], 'shots' => 15],
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

        isset($data['shots']) ? $shots = $data['shots'] : $shots = 6; // we arbitrary propose 6 shots by numbers by default
        $number->setShots($shots);

        // add attribute
        if (isset($data['attributes'])) {
            $attributeRepository = $manager->getRepository(Attribute::class);

            foreach ($data['attributes'] as $attributeUuid) {
                $attribute = $attributeRepository->findOneByUuid($attributeUuid);
                $number->addAttribute($attribute);
            }
        }

        $number->setContributors(null);

        // add performer
        if (isset($data['performers'])) {
            $personRepository = $manager->getRepository(Person::class);
            foreach ($data['performers'] as $performerName) {
                $performer = $personRepository->findOneByLastname($performerName);
                $work = new Work();
                $work->setTargetUuid($data['uuid']);
                $work->setTargetType(ModelConstants::NUMBER_MODEL);
                $work->setPerson($performer);
                $work->setProfession('performer');
                $manager->persist($work);
            }
        }

        return $number;
    }

    public function getDependencies()
    {
        return array(
            FilmFixtures::class,
            PersonFixtures::class
        );
    }
}