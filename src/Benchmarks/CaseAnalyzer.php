<?php declare(strict_types=1);

namespace Benchmarks;

use Entities\MeasureReport;

class CaseAnalyzer implements CaseAnalyzerInterface
{
    public function run(MeasureReport $report, CaseStudyInterface $caseStudy): void
    {
        $testedWebsiteMeasurement = $report->getTestedWebsiteMeasurement();

        $brokenRules = [];
        foreach ($report->getComparedWebsitesMeasurements() as $websiteMeasurement) {
            $response = $caseStudy->test($testedWebsiteMeasurement, $websiteMeasurement);

            if ($response) {
                $brokenRules = array_unique(array_merge($brokenRules, $response));
            }
        }

        if (!empty($brokenRules)) {
            $caseStudy->notify($report, $brokenRules);
        }
    }
}
