<?php declare(strict_types=1);

namespace Entities;

class Report
{
    /**
     * @var Measurement
     */
    private $testedWebsiteMeasurement;

    /**
     * @var Measurement[]
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

    public function setTestedWebsiteMeasurement(Measurement $testedWebsiteMeasurement): Report
    {
        $this->testedWebsiteMeasurement = $testedWebsiteMeasurement;

        return $this;
    }

    public function getComparedWebsitesMeasurements(): array
    {
        return $this->comparedWebsitesMeasurements;
    }

    public function setComparedWebsitesMeasurements($comparedWebsitesMeasurements): Report
    {
        $this->comparedWebsitesMeasurements = $comparedWebsitesMeasurements;

        return $this;
    }
}
