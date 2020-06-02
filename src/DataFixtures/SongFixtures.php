<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Attribute;
use App\Entity\Category;
use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class SongFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0;  $i <7; $i++) {
            $song = $this->generateSong($manager);
            $manager->persist($song);
        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @return Song
     */
    public function generateSong(ObjectManager $manager) :Song
    {
        // add 7 songs
        $songTitlesList = ["It's a Grand Night for Singing", "A Pretty Girl Is Like a Melody", "I'm Hummin', I'm Whistlin', I'm Singin'", "Sing a Song of Sixpence", "Since They Turned Loch Lomond into Swing", "Sing, Sing, Sing", "Honestly Sincere"];

        $uuidList = ['f42bb9a6-09b2-44a8-a887-3f590b93cc03', 'f0576f50-910d-4dc7-a639-c3bf5bf77fcc', '9560d8b0-f086-4623-92ff-1d1d25c17aca', '70d9a691-ddec-4756-bc34-8f152de78942', '7b8601c7-dab6-4bf0-8b09-da2d2f1cf96c', '61923f6b-9017-451f-a27b-0a936f4266bb', 'd53bab96-4fa9-497c-9527-f361ef9f7272'];

        $yearsList = [1919, 1934, 1956, 1962, 1967, 1971, 1973];

        $index = $this->faker->unique()->numberBetween(0, count($songTitlesList)-1);

        $song = new Song();
        $song->setTitle($songTitlesList[$index]);
        $song->setYear($yearsList[$index]);
        $song->setUuid($uuidList[$index]);

        // add composers
        // todo

        // add lyricists
        // todo

        // add numbers
        // todo

        // add song type
        $attributeRepository = $manager->getRepository(Attribute::class);
        $songTypeAttributes = $attributeRepository->findAttributesByCategory('songtype');

        foreach ($songTypeAttributes as $attribute) {
            $song->addAttribute($attribute);
        }

        return $song;
    }

    /**
     * @return string[]
     */
    public function getDependencies():array
    {
        return array(
            AttributeFixtures::class,
        );
    }

}