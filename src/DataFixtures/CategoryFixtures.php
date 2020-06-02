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
            $category = $this->generateGenericCategory($i);
            $manager->persist($category);
        }

        // add song type category for songs
        $songType = $this->generateCategory($this->normalize('Song Type', '55a40d04-420e-4ff8-8243-e874cf49db29', '', 'songtype', 'song'));
        $manager->persist($songType);

        $manager->flush();
    }

    /**
     * @param array $data
     * @return Category
     */
    public function generateCategory(array $data):Category
    {
        $category = new Category();
        $category->setTitle($data['title']);

        if ($data['description']) {
            $category->setDescription($data['description']);
        }

        if ($data['code']) {
            $category->setCode($data['code']);
        }

        if ($data['model']) {
            $category->setModel($data['model']);
        }

        $category->setUuid($data['uuid']);

        return $category;
    }

    /**
     * @param int $i
     * @return Category
     */
    public function generateGenericCategory(int $i): Category
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

    /**
     * @param string $title
     * @param string $uuid
     * @param string $description
     * @param string $code
     * @param string $model
     * @return array|string[]
     */
    public function normalize(
        string $title,
        string $uuid,
        string $description = '',
        string $code = '',
        string $model = ''
    ):array
    {
        return [
            "title" => $title,
            "description" => $description,
            "code" => $code,
            "model" => $model,
            "uuid" =>  $uuid
        ];
    }
}