<?php


namespace App\Component\Stats\Strategy;


use App\Component\DTO\Stats\Attribute\AttributeStatsDTO;
use App\Component\Model\ModelConstants;
use App\Component\Stats\Definition\StatsStrategyInteface;
use App\Entity\Attribute;
use App\Entity\Statistic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AttributeStatsStrategy implements StatsStrategyInteface
{
    const ATTRIBUTE_STATS_KEY = 'attributeStats';

    static function saveStats(string $attributeUuid, EntityManagerInterface $em, $options = []): void
    {
        // if stat already exists, it's an update, if not we create a new stat
        if (!$stat = $em->getRepository(Statistic::class)->findOneBy(['targetUuid' => $attributeUuid, 'key' => self::ATTRIBUTE_STATS_KEY])) {
            $stat = new Statistic();
            $stat->setKey(self::ATTRIBUTE_STATS_KEY);
            $stat->setTargetUuid($attributeUuid);
            $stat->setModel(ModelConstants::ATTRIBUTE_MODEL);
        }

        $attributesStatsDTO = self::computeStats($attributeUuid, $em, $options['model']);

        // convert StatsDTO into array
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);
        $stat->setValue($serializer->normalize($attributesStatsDTO));
        $em->persist($stat);
        $em->flush();
    }

    static function computeStats(string $attributeUuid, EntityManagerInterface $em, string $model): AttributeStatsDTO
    {
        $attributeStats = new AttributeStatsDTO();
        $stats = [];

        // compute stats
        if ($model === ModelConstants::FILM_MODEL) {
            $stats = $em->getRepository(Attribute::class)->countAttributeFilmsByYears($attributeUuid);
        }

        else if ($model === ModelConstants::NUMBER_MODEL) {
            $stats = $em->getRepository(Attribute::class)->countAttributeNumbersByYears($attributeUuid);
        }

        else if ($model === ModelConstants::SONG_MODEL) {
            $stats = $em->getRepository(Attribute::class)->countAttributeSongsByYears($attributeUuid);
        }

        $attributeStats->setCountByYears($stats);

        return $attributeStats;
    }

}