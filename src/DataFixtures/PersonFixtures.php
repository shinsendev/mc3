<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $personData) {
            $person = $this->generatePerson($personData);
            $manager->persist($person);
        }

        $manager->flush();
    }

    protected function getData()
    {
        return [
            ['firstname'=> 'Fred', 'lastname'=> 'Astaire', 'uuid' => 'a092dcb7-e7c4-4b20-b0a4-c1481b97022c', 'gender' => Person::GENDER_MALE ],
            ['firstname'=> 'Judy', 'lastname'=> 'Garland', 'uuid' => 'de1caee7-b056-41b7-a922-a60d64371061', 'gender' => Person::GENDER_FEMALE ],
            ['firstname'=> 'Gene', 'lastname'=> 'Kelly', 'uuid' => '1da12909-4a03-4949-a47c-515b5a1adf0e', 'gender' => Person::GENDER_MALE ],
            ['firstname'=> 'Shirley', 'lastname'=> 'Temple', 'uuid' => 'b7518626-92f0-41bc-b52e-8b4d99a5a671', 'gender' => Person::GENDER_FEMALE ],
        ];
    }

    protected function generatePerson()
    {
        $person = new Person();
        //todo: add logic to hydrate person
        return $person;
    }
}
