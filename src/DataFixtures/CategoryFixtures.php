<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CategoryFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $category = $this->generateCategory($i);
            $manager->persist($category);
        }

        $manager->flush();
    }

    /**
     * @param int $i
     * @return Category
     */
    public function generateCategory(int $i): Category
    {

        $titles = ["Ethnic stereotypes", "Exoticism", "censorship"];
        $codes = ["stereotype", "exoticism_thesaurus", "censorship"];
        $uuids = ["6d9ade45-877a-4b99-bb1b-408d9e3087f4", "d720cdfc-ab15-4363-8d56-e9a1ae2fe9e7", "0b16d192-976b-477b-9bcd-24df71564b0b"];
        $models = ['number', null, 'film'];
        $descriptions = ["Multiple choices. Ethnic impersonation. Includes all racial and national stereotypes (accents, costumes, make-up, etc.).", "Multiple choices. General themes of the number as far as non American cultures are concerned. Depends on the music, dancing, costumes, setting.", null];

        $category = new Category();
        $category->setTitle($titles[$i]);
        $category->setDescription($descriptions[$i]);
        $category->setCode($codes[$i]);
        $category->setModel($models[$i]);
        $category->setUuid($uuids[$i]);

        return $category;
    }
}