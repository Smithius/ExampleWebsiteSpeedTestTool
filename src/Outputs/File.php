<?php declare(strict_types=1);

namespace Outputs;

use DateTime;
use Entities\MeasureReport;

class File extends BaseOutput
{
    /**
     * @var string
     */
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function write(MeasureReport $report): void
    {
        $now = new DateTime();
        $output = $now->format(DateTime::ISO8601) . "\n" . $this->getHeader();
        $baseMeasurement = $report->getTestedWebsiteMeasurement();
        $output .= $this->formatToStringData($baseMeasurement);

        foreach ($report->getComparedWebsitesMeasurements() as $pageMeasurement) {
            $output .= $this->formatToStringData($pageMeasurement, $baseMeasurement);
        }
        $output .= "\n";

        file_put_contents($this->filename, $output, FILE_APPEND);
    }
}
