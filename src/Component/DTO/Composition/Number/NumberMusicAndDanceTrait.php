<?php

declare(strict_types=1);


namespace App\Component\DTO\Composition\Number;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait NumberMusicAndDanceTrait
 * @package App\Component\DTO\Composition\Number
 */
trait NumberMusicAndDanceTrait
{
    /**
     * @Groups({"export"})
     */
    protected array $songs = []; // NestedSongDTO[]

    /**
     * @Groups({"export"})
     */
    protected array $musicalEnsemble = []; //

    /**
     * @Groups({"export"})
     */
    protected string $dubbing = 'NA'; // from number, not an attribute

    /**
     * @Groups({"export"})
     */
    protected array $tempo = []; // SongDTO or NestedSongDTO

    /**
     * @Groups({"export"})
     */
    protected array $musicalStyles = []; // SongDTO or NestedSongDTO

    /**
     * @Groups({"export"})
     */
    protected array $arrangers = []; // PersonNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $danceDirectors = []; // PersonNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $danceEnsemble = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $dancingType = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $danceSubgenre = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $danceContent = []; // AttributeNestedDTO

    /**
     * @return array
     */
    public function getSongs(): array
    {
        return $this->songs;
    }

    /**
     * @param array $songs
     */
    public function setSongs(array $songs): void
    {
        $this->songs = $songs;
    }


    /**
     * @return array
     */
    public function getMusicalEnsemble(): array
    {
        return $this->musicalEnsemble;
    }

    /**
     * @param array $musicalEnsemble
     */
    public function setMusicalEnsemble(array $musicalEnsemble): void
    {
        $this->musicalEnsemble = $musicalEnsemble;
    }

    /**
     * @return string
     */
    public function getDubbing(): string
    {
        return $this->dubbing;
    }

    /**
     * @param string $dubbing
     */
    public function setDubbing(string $dubbing): void
    {
        $this->dubbing = $dubbing;
    }

    /**
     * @return array
     */
    public function getTempo(): array
    {
        return $this->tempo;
    }

    /**
     * @param array $tempo
     */
    public function setTempo(array $tempo): void
    {
        $this->tempo = $tempo;
    }

    /**
     * @return array
     */
    public function getMusicalStyles(): array
    {
        return $this->musicalStyles;
    }

    /**
     * @param array $musicalStyles
     */
    public function setMusicalStyles(array $musicalStyles): void
    {
        $this->musicalStyles = $musicalStyles;
    }

    /**
     * @return array
     */
    public function getArrangers(): array
    {
        return $this->arrangers;
    }

    /**
     * @param array $arrangers
     */
    public function setArrangers(array $arrangers): void
    {
        $this->arrangers = $arrangers;
    }

    /**
     * @return array
     */
    public function getDanceDirectors(): array
    {
        return $this->danceDirectors;
    }

    /**
     * @param array $danceDirectors
     */
    public function setDanceDirectors(array $danceDirectors): void
    {
        $this->danceDirectors = $danceDirectors;
    }

    /**
     * @return array
     */
    public function getDanceEnsemble(): array
    {
        return $this->danceEnsemble;
    }

    /**
     * @param array $danceEnsemble
     */
    public function setDanceEnsemble(array $danceEnsemble): void
    {
        $this->danceEnsemble = $danceEnsemble;
    }

    /**
     * @return array
     */
    public function getDancingType(): array
    {
        return $this->dancingType;
    }

    /**
     * @param array $dancingType
     */
    public function setDancingType(array $dancingType): void
    {
        $this->dancingType = $dancingType;
    }

    /**
     * @return array
     */
    public function getDanceSubgenre(): array
    {
        return $this->danceSubgenre;
    }

    /**
     * @param array $danceSubgenre
     */
    public function setDanceSubgenre(array $danceSubgenre): void
    {
        $this->danceSubgenre = $danceSubgenre;
    }

    /**
     * @return array
     */
    public function getDanceContent(): array
    {
        return $this->danceContent;
    }

    /**
     * @param array $danceContent
     */
    public function setDanceContent(array $danceContent): void
    {
        $this->danceContent = $danceContent;
    }

}
