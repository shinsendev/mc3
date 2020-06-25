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
            ['groupname'=> 'Sharks', 'uuid' => '44b995b2-a734-447b-9297-a9e8fb7fa542'],
        ];
    }

    protected function generatePerson(array $personData)
    {
        $person = new Person();

        if (isset($personData['firstname'])) {
            $person->setFirstname($personData['firstname']);
        }
        if (isset($personData['lastname'])) {
            $person->setLastname($personData['lastname']);
        }

        if (isset($personData['groupname'])) {
            $person->setGroupname($personData['groupname']);
        }

        if (isset($personData['gender'])) {
            $person->setGender($personData['gender']);
        }

        if (isset($personData['viaf'])) {
            $person->setViaf($personData['viaf']);
        }

        $person->setUuid($personData['uuid']);

        return $person;
    }
}
