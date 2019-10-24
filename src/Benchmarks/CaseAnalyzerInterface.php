<?php declare(strict_types=1);

namespace Benchmarks;

use Entities\MeasureReport;

interface CaseAnalyzerInterface
{
    public function run(MeasureReport $report, CaseStudyInterface $caseStudy): void;
}
