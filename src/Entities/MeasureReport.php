<?php declare(strict_types=1);

namespace Entities;

class MeasureReport
{
    /**
     * @var Measurement
     */
    private $testedWebsiteMeasurement;

    /**
     * @var array|Measurement[]
     */
    private $comparedWebsitesMeasurements;

    public function __construct($testedPageMeasurement, $comparedPagesMeasurement)
    {
        $this->testedWebsiteMeasurement = $testedPageMeasurement;
        $this->comparedWebsitesMeasurements = $comparedPagesMeasurement;
    }

    public function getTestedWebsiteMeasurement(): Measurement
    {
        return $this->testedWebsiteMeasurement;
    }

    public function setTestedWebsiteMeasurement(Measurement $testedWebsiteMeasurement): MeasureReport
    {
        $this->testedWebsiteMeasurement = $testedWebsiteMeasurement;

        return $this;
    }

    public function getComparedWebsitesMeasurements(): array
    {
        return $this->comparedWebsitesMeasurements;
    }

    public function setComparedWebsitesMeasurements(array $comparedWebsitesMeasurements): MeasureReport
    {
        $this->comparedWebsitesMeasurements = $comparedWebsitesMeasurements;

        return $this;
    }
}
