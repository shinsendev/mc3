<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Component\Factory\DTOFactory;
use App\Component\Model\ModelConstants;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @Route("/", name="getHome")
     *
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function getHomepage(EntityManagerInterface $em)
    {
        $homeDTO = DTOFactory::create(ModelConstants::HOME_PAYLOAD_MODEL);
        $homeDTO->hydrate([], $em);

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $response = $serializer->serialize($homeDTO, 'json');

        return new Response($response, 200, ['Content-Type' => 'application/json']);
    }
}