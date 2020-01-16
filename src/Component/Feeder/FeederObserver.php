<?php


namespace App\Component\Feeder;


class FeederObserver
{
    /** @var integer */
    private $line = 0;

    /**
     * @return int
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * @param int $line
     */
    public function setLine(int $line): void
    {
        $this->line = $line;
    }
}