<?php declare(strict_types=1);

namespace Benchmarks;

use Entities\Measurement;

interface PageMeasurerInterface
{
    public function measure(string $url): ?Measurement;
}
