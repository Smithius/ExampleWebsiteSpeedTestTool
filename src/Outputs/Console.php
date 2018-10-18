<?php declare(strict_types=1);

namespace Outputs;

use Entities\Report;
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

    public function write(Report $report): void
    {
        $this->output->writeln($this->formatToStringData($report->getTestedWebsiteMeasurement()));

        foreach ($report->getComparedWebsitesMeasurements() as $pageMeasurement) {
            $this->output->writeln($this->formatToStringData($pageMeasurement));
        }
    }
}
