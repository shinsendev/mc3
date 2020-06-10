<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Attribute;
use App\Entity\Film;
use App\Entity\Studio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class FilmFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0;  $i <2; $i++) {
            $film = $this->generateFilm($i, $manager);
            $manager->persist($film);
        }

        $manager->flush();
    }

    /**
     * @param int $index
     * @param ObjectManager $manager
     * @return Film
     */
    public function generateFilm(int $index, ObjectManager $manager) :Film
    {
        $titles = ["West Side Story", "The Jazz Singer"];
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

        // add numbers
        //todo : add links to numbers

        // add censorship attributes
        $attributeRepository = $manager->getRepository(Attribute::class);

        if ($index === 0) {
            // dialog
            $attributes[] = $attributeRepository->findOneByUuid('27b11176-9555-4fa5-bda9-85aa76147843');

            //lyrics-unsignificant
            $attributes[] = $attributeRepository->findOneByUuid('c713385e-a147-49a1-a3fe-6baf47450556');

            //narrative-minor problem
            $attributes[] = $attributeRepository->findOneByUuid('06172795-8184-4858-89c3-f8313486dfbd');
        }

        else {
            //dialog
            $attributes[] = $attributeRepository->findOneByUuid('27b11176-9555-4fa5-bda9-85aa76147843');
        }

        foreach ($attributes as $attribute) {
            $film->addAttribute($attribute);
        }

        // add studio
        $mgm = new Studio();
        $mgm->setName('MGM');
        $mgm->setUuid('3b35a14e-4dbb-4ec5-b51b-d26553befc34');
        $manager->persist($mgm);
        $manager->flush(); // save studio

        $film->addStudio($mgm);

        return $film;
    }

    public function getDependencies()
    {
        return array(
            AttributeFixtures::class,
        );
    }
}