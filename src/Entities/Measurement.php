<?php declare(strict_types=1);

namespace Entities;

class Measurement
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var float
     */
    private $time;

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Measurement
    {
        $this->url = $url;

        return $this;
    }

    public function getTime(): float
    {
        return $this->time;
    }

    public function setTime(float $time): Measurement
    {
        $this->time = $time;

        return $this;
    }
}
