<?php declare(strict_types=1);

namespace Outputs;

use Entities\MeasureReport;
use Symfony\Component\Console\Output\OutputInterface;

class Console extends BaseOutput
{
    /**
     * @var OutputInterface|null
     */
    private $output;

    public function __construct(OutputInterface $output = null)
    {
        $this->output = $output;
    }

    public function write(MeasureReport $report): void
    {
        $this->output->write($this->getHeader());
        $baseMeasurement = $report->getTestedWebsiteMeasurement();
        $this->output->write($this->formatToStringData($baseMeasurement));

        foreach ($report->getComparedWebsitesMeasurements() as $pageMeasurement) {
            $this->output->write($this->formatToStringData($pageMeasurement, $baseMeasurement));
        }
    }
}
