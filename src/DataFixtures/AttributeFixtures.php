<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Attribute;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AttributeFixtures extends Fixture
{
    /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $song = $this->generateAttribute($i);
            $manager->persist($song);
        }

        $manager->flush();
    }

    /**
     * @return Category
     */
    public function generateAttribute(int $i): Attribute
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

        $category = '';
        $attribute->setCategory($category);

        return $attribute;
    }
}