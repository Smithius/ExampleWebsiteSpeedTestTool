<?php declare(strict_types=1);

namespace Outputs;

use Entities\Measurement;

abstract class BaseOutput implements OutputInterface
{
    public function formatToStringData(Measurement $measurement): string
    {
        return implode(" | ", $this->getOutputData($measurement));
    }

    public function getOutputData(Measurement $measurement): array
    {
        return [
            $measurement->getUrl(),
            $measurement->getTime(),
            $measurement->getParentMeasurement() ? $measurement->getTimeDiff() : '',
        ];
    }
}
