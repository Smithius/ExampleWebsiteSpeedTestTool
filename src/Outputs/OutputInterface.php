<?php declare(strict_types=1);

namespace Outputs;

use Entities\MeasureReport;

interface OutputInterface
{
    public function write(MeasureReport $report): void;
}
