<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Model\ModelConstants;
use App\Controller\NotFoundController;
use App\Entity\Film;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class HomePayloadDTO
 * @package App\Component\DTO\Payload
 */
class HomePayloadDTO extends AbstractUniqueDTO
{
    /** @var int */
    private $filmsCount = 0;

    /** @var  int */
    private $filmsWithNumberCount = 0;

    //todo: add blogs articles DTO
    /** @var void|array */
    private $blogArticles;

    //todo: add PersonNestedDTO
    /** @var void|array */
    private $performers;

    /** @var void|FilmNestedDTO[] */
    private $films;

    public function hydrate(array $data, EntityManagerInterface $em)
    {
        $filmRepository = $em->getRepository(Film::class);

        // count all films
        $totalFilms = $filmRepository->countFilms();
        $this->setFilmsCount($totalFilms);

        // count film with numbers
        $totalFilms = $filmRepository->countFilmsWithNumbers();
        $this->setFilmsWithNumberCount($totalFilms);

        // get last blog articles
        //todo : add articles with pagination

        // get 30 performers with the most numbers associated
        $persons = $em->getRepository(Person::class)->findPopularPersons(30);
        foreach ($persons as $person) {
            dd($person);
        }
        dd($persons->count());
        //todo: continue the collect of persons

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
            $filmDTO = DTOFactory::create(ModelConstants::NESTED_FILM_MODEL);
            $filmArray = [
                'title' => $film->getTitle(),
                'uuid' => $film->getUuid(),
            ];
            $filmDTO->hydrate(['film' => $filmArray], $em);
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
     * @return array|void
     */
    public function getPerformers()
    {
        return $this->performers;
    }

    /**
     * @param array|void $performers
     */
    public function setPerformers($performers): void
    {
        $this->performers = $performers;
    }

    /**
     * @return FilmNestedDTO[]|void
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * @param FilmNestedDTO[]|void $films
     */
    public function setFilms($films): void
    {
        $this->films = $films;
    }

}