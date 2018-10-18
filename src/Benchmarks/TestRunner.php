<?php declare(strict_types=1);

namespace Benchmarks;

use Entities\Report;

class TestRunner
{
    /**
     * @var TestCase[]
     */
    private $tests;

    /**
     * @var Report
     */
    private $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function addTest(TestCase $test): TestRunner
    {
        $this->tests[] = $test;

        return $this;
    }

    public function run(): void
    {
        foreach ($this->tests as $testCase) {
            foreach ($this->report->getComparedWebsitesMeasurements() as $websiteMeasurement) {
                //Results could be collect here
                $testCase->test($this->report->getTestedWebsiteMeasurement(), $websiteMeasurement);
            }
        }

        foreach ($this->tests as $test) {
            $test->notify($this->report);
        }
    }
}
