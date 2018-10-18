<?php declare(strict_types=1);

namespace Entities;

class Measurement
{
    /**
     * @var Measurement
     */
    private $parentMeasurement = null;

    /**
     * @var string
     */
    private $url;

    /**
     * @var float
     */
    private $time;

    public function __construct(string $url, float $time)
    {
        $this->url = $url;
        $this->time = $time;
    }

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

    public function getParentMeasurement(): ?Measurement
    {
        return $this->parentMeasurement;
    }

    public function setParentMeasurement(Measurement $parentMeasurement): Measurement
    {
        $this->parentMeasurement = $parentMeasurement;

        return $this;
    }

    public function getTimeDiff(): float
    {
        return $this->parentMeasurement->getTime() - $this->getTime();
    }
}
