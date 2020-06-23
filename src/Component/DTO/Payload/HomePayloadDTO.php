<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use App\Component\DTO\Hierarchy\AbstractDTO;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\NestedFilmHydrator;
use App\Component\Hydrator\Strategy\PersonPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use App\Entity\Category;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Person;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class HomePayloadDTO
 * @package App\Component\DTO\Payload
 */
class HomePayloadDTO extends AbstractDTO
{
    /** @var int */
    private $filmsCount = 0;

    /** @var  int */
    private $filmsWithNumberCount = 0;

    /** @var int */
    private $numbersCount = 0;

    /** @var int */
    private $songsCount = 0;

    /** @var int */
    private $personsCount = 0;

    /** @var int */
    private $attributesCount = 0;

    /** @var int */
    private $categoriesCount = 0;

    //todo: add blogs articles DTO
    /** @var void|array */
    private $blogArticles;

    /** @var array */
    private $performers = [];

    /** @var FilmNestedDTO[] */
    private $films = [];

    public function hydrate(array $data, EntityManagerInterface $em)
    {
        $filmRepository = $em->getRepository(Film::class);

        // count all films
        $totalFilms = $filmRepository->countFilms();
        $this->setFilmsCount($totalFilms);

        // count film with numbers
        $totalFilms = $filmRepository->countFilmsWithNumbers();
        $this->setFilmsWithNumberCount($totalFilms);

        // count numbers
        $totalNumbers = $em->getRepository(Number::class)->countNumbers();
        $this->setNumbersCount($totalNumbers);

        // count attributes
        $totalAttributes = $em->getRepository(Attribute::class)->countAttributes();
        $this->setAttributesCount($totalAttributes);

        // count songs
        $totalSongs = $em->getRepository(Song::class)->countSongs();
        $this->setSongsCount($totalSongs);

        // count categories
        $totalCategories = $em->getRepository(Category::class)->countCategories();
        $this->setCategoriesCount($totalCategories);

        // count persons
        $totalPersons = $em->getRepository(Person::class)->countPersons();
        $this->setPersonsCount($totalPersons);

        // get last blog articles
        //todo : add articles with pagination

        // get 30 performers with the most numbers associated
        $personsData = $em->getRepository(Person::class)->findPaginatedPopularPersonsByJob(30, 'performer');
        foreach ($personsData as $personData) {
            $personDTO = DTOFactory::create(ModelConstants::PERSON_NESTED_DTO_MODEL);
            $personDTO = PersonPayloadHydrator::hydrate($personDTO, $personData, $em);
            $performers[] = $personDTO;
        }

        if(isset($performers)) {
            $this->setPerformers($performers);
        }

        // get paginated films with data = with numbers
        if (isset($data['filmsWithNumber'])) {
            $limit= $data['filmsWithNumber']['limit'];
            $offset= $data['filmsWithNumber']['offset'];
        }
        else {
            $limit = 30;
            $offset = 0;
        }

        $films = $filmRepository->findPaginatedFilmsWithNumbers($limit, $offset);

        foreach ($films as $film) {
            $filmDTO = DTOFactory::create(ModelConstants::FILM_NESTED_DTO_MODEL);
            $filmDTO = NestedFilmHydrator::hydrate($filmDTO, ['film' => $film], $em);
            $filmsDTOList[] = $filmDTO;
        }
        if(isset($filmsDTOList)) {
            $this->setFilms($filmsDTOList);
        }
    }

    /**
     * @return int
     */
    public function getFilmsCount(): int
    {
        return $this->filmsCount;
    }

    /**
     * @param int $filmsCount
     */
    public function setFilmsCount(int $filmsCount): void
    {
        $this->filmsCount = $filmsCount;
    }

    /**
     * @return int
     */
    public function getFilmsWithNumberCount(): int
    {
        return $this->filmsWithNumberCount;
    }

    /**
     * @param int $filmsWithNumberCount
     */
    public function setFilmsWithNumberCount(int $filmsWithNumberCount): void
    {
        $this->filmsWithNumberCount = $filmsWithNumberCount;
    }

    /**
     * @return int
     */
    public function getNumbersCount(): int
    {
        return $this->numbersCount;
    }

    /**
     * @param int $numbersCount
     */
    public function setNumbersCount(int $numbersCount): void
    {
        $this->numbersCount = $numbersCount;
    }

    /**
     * @return int
     */
    public function getSongsCount(): int
    {
        return $this->songsCount;
    }

    /**
     * @param int $songsCount
     */
    public function setSongsCount(int $songsCount): void
    {
        $this->songsCount = $songsCount;
    }

    /**
     * @return int
     */
    public function getPersonsCount(): int
    {
        return $this->personsCount;
    }

    /**
     * @param int $personsCount
     */
    public function setPersonsCount(int $personsCount): void
    {
        $this->personsCount = $personsCount;
    }

    /**
     * @return int
     */
    public function getAttributesCount(): int
    {
        return $this->attributesCount;
    }

    /**
     * @param int $attributesCount
     */
    public function setAttributesCount(int $attributesCount): void
    {
        $this->attributesCount = $attributesCount;
    }

    /**
     * @return int
     */
    public function getCategoriesCount(): int
    {
        return $this->categoriesCount;
    }

    /**
     * @param int $categoriesCount
     */
    public function setCategoriesCount(int $categoriesCount): void
    {
        $this->categoriesCount = $categoriesCount;
    }

    /**
     * @return array|void
     */
    public function getBlogArticles()
    {
        return $this->blogArticles;
    }

    /**
     * @param array|void $blogArticles
     */
    public function setBlogArticles($blogArticles): void
    {
        $this->blogArticles = $blogArticles;
    }

    /**
     * @return array
     */
    public function getPerformers():array
    {
        return $this->performers;
    }

    /**
     * @param array $performers
     */
    public function setPerformers($performers): void
    {
        $this->performers = $performers;
    }

    /**
     * @return FilmNestedDTO[]
     */
    public function getFilms():array
    {
        return $this->films;
    }

    /**
     * @param FilmNestedDTO[] $films
     */
    public function setFilms($films): void
    {
        $this->films = $films;
    }

}