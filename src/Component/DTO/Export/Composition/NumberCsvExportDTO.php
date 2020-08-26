<?php


namespace App\Component\DTO\Export\Composition;


trait NumberCsvExportDTO
{
// number data
    protected string $numberTitle;
    protected ?int $beginTc = null;
    protected ?int $endTc = null;
    protected ?string $shots = null;
    protected ?string $dubbing = null;
    protected ?string $uuid = null;

    // number attributes
    protected ?string $beginning = null;
    protected ?string $ending = null;
    protected ?string $outlines = null;
    protected ?string $completeness = null;
    protected ?string $structure = null;
    protected ?string $performance = null;
    protected ?string $cast = null;
    protected ?string $spectators = null;
    protected ?string $diegeticPerformance = null;
    protected ?string $musicians = null;
    protected ?string $topic = null;
    protected ?string $diegeticPlace = null;
    protected ?string $imaginaryPlace = null;
    protected ?string $stereotype = null;
    protected ?string $exoticism = null;
    protected ?string $musicalEnsemble = null;
    protected ?string $tempo = null;
    protected ?string $musicalStyles = null;
    protected ?string $danceEnsemble = null;
    protected ?string $dancingType = null;
    protected ?string $danceSubgenre = null;
    protected ?string $danceContent = null;
    protected ?string $source = null;
    protected ?string $quotation = null;

    // people connected to number
    protected ?string $numberDirectors = null;
    protected ?string $performers = null;
    protected ?string $stars = null;
    protected ?string $arrangers = null;
    protected ?string $danceDirector = null;

    /**
     * @return string
     */
    public function getNumberTitle(): string
    {
        return $this->numberTitle;
    }

    /**
     * @param string $numberTitle
     */
    public function setNumberTitle(string $numberTitle): void
    {
        $this->numberTitle = $numberTitle;
    }

    /**
     * @return int|null
     */
    public function getBeginTc(): ?int
    {
        return $this->beginTc;
    }

    /**
     * @param int|null $beginTc
     */
    public function setBeginTc(?int $beginTc): void
    {
        $this->beginTc = $beginTc;
    }

    /**
     * @return int|null
     */
    public function getEndTc(): ?int
    {
        return $this->endTc;
    }

    /**
     * @param int|null $endTc
     */
    public function setEndTc(?int $endTc): void
    {
        $this->endTc = $endTc;
    }

    /**
     * @return string|null
     */
    public function getShots(): ?string
    {
        return $this->shots;
    }

    /**
     * @param string|null $shots
     */
    public function setShots(?string $shots): void
    {
        $this->shots = $shots;
    }

    /**
     * @return string|null
     */
    public function getDubbing(): ?string
    {
        return $this->dubbing;
    }

    /**
     * @param string|null $dubbing
     */
    public function setDubbing(?string $dubbing): void
    {
        $this->dubbing = $dubbing;
    }

    /**
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @param string|null $uuid
     */
    public function setUuid(?string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string|null
     */
    public function getBeginning(): ?string
    {
        return $this->beginning;
    }

    /**
     * @param string|null $beginning
     */
    public function setBeginning(?string $beginning): void
    {
        $this->beginning = $beginning;
    }

    /**
     * @return string|null
     */
    public function getEnding(): ?string
    {
        return $this->ending;
    }

    /**
     * @param string|null $ending
     */
    public function setEnding(?string $ending): void
    {
        $this->ending = $ending;
    }

    /**
     * @return string|null
     */
    public function getOutlines(): ?string
    {
        return $this->outlines;
    }

    /**
     * @param string|null $outlines
     */
    public function setOutlines(?string $outlines): void
    {
        $this->outlines = $outlines;
    }

    /**
     * @return string|null
     */
    public function getCompleteness(): ?string
    {
        return $this->completeness;
    }

    /**
     * @param string|null $completeness
     */
    public function setCompleteness(?string $completeness): void
    {
        $this->completeness = $completeness;
    }

    /**
     * @return string|null
     */
    public function getStructure(): ?string
    {
        return $this->structure;
    }

    /**
     * @param string|null $structure
     */
    public function setStructure(?string $structure): void
    {
        $this->structure = $structure;
    }

    /**
     * @return string|null
     */
    public function getPerformance(): ?string
    {
        return $this->performance;
    }

    /**
     * @param string|null $performance
     */
    public function setPerformance(?string $performance): void
    {
        $this->performance = $performance;
    }

    /**
     * @return string|null
     */
    public function getCast(): ?string
    {
        return $this->cast;
    }

    /**
     * @param string|null $cast
     */
    public function setCast(?string $cast): void
    {
        $this->cast = $cast;
    }

    /**
     * @return string|null
     */
    public function getSpectators(): ?string
    {
        return $this->spectators;
    }

    /**
     * @param string|null $spectators
     */
    public function setSpectators(?string $spectators): void
    {
        $this->spectators = $spectators;
    }

    /**
     * @return string|null
     */
    public function getDiegeticPerformance(): ?string
    {
        return $this->diegeticPerformance;
    }

    /**
     * @param string|null $diegeticPerformance
     */
    public function setDiegeticPerformance(?string $diegeticPerformance): void
    {
        $this->diegeticPerformance = $diegeticPerformance;
    }

    /**
     * @return string|null
     */
    public function getMusicians(): ?string
    {
        return $this->musicians;
    }

    /**
     * @param string|null $musicians
     */
    public function setMusicians(?string $musicians): void
    {
        $this->musicians = $musicians;
    }

    /**
     * @return string|null
     */
    public function getTopic(): ?string
    {
        return $this->topic;
    }

    /**
     * @param string|null $topic
     */
    public function setTopic(?string $topic): void
    {
        $this->topic = $topic;
    }

    /**
     * @return string|null
     */
    public function getDiegeticPlace(): ?string
    {
        return $this->diegeticPlace;
    }

    /**
     * @param string|null $diegeticPlace
     */
    public function setDiegeticPlace(?string $diegeticPlace): void
    {
        $this->diegeticPlace = $diegeticPlace;
    }

    /**
     * @return string|null
     */
    public function getImaginaryPlace(): ?string
    {
        return $this->imaginaryPlace;
    }

    /**
     * @param string|null $imaginaryPlace
     */
    public function setImaginaryPlace(?string $imaginaryPlace): void
    {
        $this->imaginaryPlace = $imaginaryPlace;
    }

    /**
     * @return string|null
     */
    public function getStereotype(): ?string
    {
        return $this->stereotype;
    }

    /**
     * @param string|null $stereotype
     */
    public function setStereotype(?string $stereotype): void
    {
        $this->stereotype = $stereotype;
    }

    /**
     * @return string|null
     */
    public function getExoticism(): ?string
    {
        return $this->exoticism;
    }

    /**
     * @param string|null $exoticism
     */
    public function setExoticism(?string $exoticism): void
    {
        $this->exoticism = $exoticism;
    }

    /**
     * @return string|null
     */
    public function getMusicalEnsemble(): ?string
    {
        return $this->musicalEnsemble;
    }

    /**
     * @param string|null $musicalEnsemble
     */
    public function setMusicalEnsemble(?string $musicalEnsemble): void
    {
        $this->musicalEnsemble = $musicalEnsemble;
    }

    /**
     * @return string|null
     */
    public function getTempo(): ?string
    {
        return $this->tempo;
    }

    /**
     * @param string|null $tempo
     */
    public function setTempo(?string $tempo): void
    {
        $this->tempo = $tempo;
    }

    /**
     * @return string|null
     */
    public function getMusicalStyles(): ?string
    {
        return $this->musicalStyles;
    }

    /**
     * @param string|null $musicalStyles
     */
    public function setMusicalStyles(?string $musicalStyles): void
    {
        $this->musicalStyles = $musicalStyles;
    }

    /**
     * @return string|null
     */
    public function getDanceEnsemble(): ?string
    {
        return $this->danceEnsemble;
    }

    /**
     * @param string|null $danceEnsemble
     */
    public function setDanceEnsemble(?string $danceEnsemble): void
    {
        $this->danceEnsemble = $danceEnsemble;
    }

    /**
     * @return string|null
     */
    public function getDancingType(): ?string
    {
        return $this->dancingType;
    }

    /**
     * @param string|null $dancingType
     */
    public function setDancingType(?string $dancingType): void
    {
        $this->dancingType = $dancingType;
    }

    /**
     * @return string|null
     */
    public function getDanceSubgenre(): ?string
    {
        return $this->danceSubgenre;
    }

    /**
     * @param string|null $danceSubgenre
     */
    public function setDanceSubgenre(?string $danceSubgenre): void
    {
        $this->danceSubgenre = $danceSubgenre;
    }

    /**
     * @return string|null
     */
    public function getDanceContent(): ?string
    {
        return $this->danceContent;
    }

    /**
     * @param string|null $danceContent
     */
    public function setDanceContent(?string $danceContent): void
    {
        $this->danceContent = $danceContent;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     */
    public function setSource(?string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return string|null
     */
    public function getQuotation(): ?string
    {
        return $this->quotation;
    }

    /**
     * @param string|null $quotation
     */
    public function setQuotation(?string $quotation): void
    {
        $this->quotation = $quotation;
    }

    /**
     * @return string|null
     */
    public function getNumberDirectors(): ?string
    {
        return $this->numberDirectors;
    }

    /**
     * @param string|null $numberDirectors
     */
    public function setNumberDirectors(?string $numberDirectors): void
    {
        $this->numberDirectors = $numberDirectors;
    }

    /**
     * @return string|null
     */
    public function getPerformers(): ?string
    {
        return $this->performers;
    }

    /**
     * @param string|null $performers
     */
    public function setPerformers(?string $performers): void
    {
        $this->performers = $performers;
    }

    /**
     * @return string|null
     */
    public function getStars(): ?string
    {
        return $this->stars;
    }

    /**
     * @param string|null $stars
     */
    public function setStars(?string $stars): void
    {
        $this->stars = $stars;
    }

    /**
     * @return string|null
     */
    public function getArrangers(): ?string
    {
        return $this->arrangers;
    }

    /**
     * @param string|null $arrangers
     */
    public function setArrangers(?string $arrangers): void
    {
        $this->arrangers = $arrangers;
    }

    /**
     * @return string|null
     */
    public function getDanceDirector(): ?string
    {
        return $this->danceDirector;
    }

    /**
     * @param string|null $danceDirector
     */
    public function setDanceDirector(?string $danceDirector): void
    {
        $this->danceDirector = $danceDirector;
    }

}