<?php declare(strict_types=1);

namespace Outputs;

use Entities\Report;

class File extends BaseOutput
{
    public function write(Report $report): void
    {
        $output = $this->formatToStringData($report->getTestedWebsiteMeasurement()) . "\n";

        foreach ($report->getComparedWebsitesMeasurements() as $pageMeasurement) {
            $output .= $this->formatToStringData($pageMeasurement) . "\n";
        }

        file_put_contents('log.txt', $output);
    }
}
