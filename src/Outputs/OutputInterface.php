<?php declare(strict_types=1);

namespace Outputs;

use Entities\Report;

interface OutputInterface
{
    public function write(Report $report): void;
}
