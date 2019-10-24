<?php declare(strict_types=1);

namespace Outputs;

use Entities\Measurement;

abstract class BaseOutput implements OutputInterface
{
    protected $mask = "| %-30.30s | %-10.10s | %-10.10s |\n";

    public function getHeader()
    {
        return sprintf($this->mask, 'Page url', 'Time (sec)', 'Diff (sec)');
    }

    public function formatToStringData(Measurement $measurement, ?Measurement $baseMeasurement = null): string
    {
        return vsprintf($this->mask, $this->getOutputData($measurement, $baseMeasurement));
    }

    public function getOutputData(Measurement $measurement, ?Measurement $baseMeasurement = null): array
    {
        return [
            $measurement->getUrl(),
            (string)$measurement->getTime(),
            (string)($baseMeasurement ? $baseMeasurement->getTime() - $measurement->getTime() : ''),
        ];
    }
}
