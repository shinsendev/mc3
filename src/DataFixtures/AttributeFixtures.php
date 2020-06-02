<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Attribute;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AttributeFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var Generator */
    protected $faker;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        // generic attributes
        for ($i = 0; $i < 5; $i++) {
            $attribute = $this->generateGenericAttribute($i, $manager);
            $manager->persist($attribute);
        }

        // add songtype category
        $categoryRepository = $manager->getRepository(Category::class);
        $songType = $categoryRepository->findOneByUuid("55a40d04-420e-4ff8-8243-e874cf49db29");

        // song attributes
        $ragtime = $this->normalize("Ragtime", "629981fd-7a22-433d-8c6c-8d9aac40d815","\"coon song\"", "");
        $ragtime = $this->generateAttribute($ragtime);
        $ragtime->setCategory($songType);
        $manager->persist($ragtime);

        $dance = $this->normalize("Dance", "fef46840-194a-4987-ae29-aea2faae9ee8","Lyric is about dancing or dance instruction", "");
        $dance = $this->generateAttribute($dance);
        $dance->setCategory($songType);
        $manager->persist($dance);

        $manager->flush();
    }

    /**
     * @param int $i
     * @param ObjectManager $manager
     * @return Attribute
     */
    public function generateGenericAttribute(int $i, ObjectManager $manager): Attribute
    {
        $titles = ["dialogue", "lyrics-unsignificant", "narrative-minor problem", "asian", "savage"];
        $descriptions = ["", "", "", "Generally asian but no specific country or area is identifiable", "Any type of number involving savage and wild dances but without a specific location (could be African, Haitian...)"];
        $examples = ["", "", "", "", "\"Monkey Doodle-Doo\" in The Cocoanuts"];
        $uuids = ["27b11176-9555-4fa5-bda9-85aa76147843", "c713385e-a147-49a1-a3fe-6baf47450556", "06172795-8184-4858-89c3-f8313486dfbd", "29a0dfee-abb4-423b-8b3d-54b69904fa95", "6c2bc54f-6d47-4638-adc0-7692803065d6"];

        $attribute = new Attribute();
        $attribute->setTitle($titles[$i]);
        $attribute->setDescription($descriptions[$i]);
        $attribute->setExample($examples[$i]);
        $attribute->setUuid($uuids[$i]);

        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = $manager->getRepository(Category::class);
        // censorship category

        if ($i < 3) {
            /** @var Category $category */
            $category = $categoryRepository->findOneByUuid("0b16d192-976b-477b-9bcd-24df71564b0b");

        }
        // exoticism
        else {
            /** @var Category $category */
            $category = $categoryRepository->findOneByUuid("d720cdfc-ab15-4363-8d56-e9a1ae2fe9e7");
        }
        $attribute->setCategory($category);

        return $attribute;
    }

    /**
     * @param array $data
     * @return Attribute
     */
    public function generateAttribute(array $data):Attribute
    {
        $attribute = new Attribute();
        $attribute->setTitle($data['title']);

        if ($data['description']) {
            $attribute->setDescription($data['description']);
        }

        if ($data['example']) {
            $attribute->setExample($data['example']);
        }

        $attribute->setUuid($data['uuid']);

        return $attribute;
    }

    /**
     * @param string $title
     * @param string $uuid
     * @param string $description
     * @param string $example
     * @return array
     */
    public function normalize(string $title, string $uuid, string $description = '', string $example = ''):array
    {
        return [
            "title" => $title,
            "description" => $description,
            "example" => $example,
            "uuid" =>  $uuid
        ];
    }

    /**
     * @return string[]
     */
    public function getDependencies():array
    {
        return array(
            CategoryFixtures::class,
        );
    }
}