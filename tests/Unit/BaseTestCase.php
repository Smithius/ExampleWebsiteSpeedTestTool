<?php declare(strict_types=1);

use Entities\Measurement;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected function generateMeasurement(float $value): Measurement
    {
        return (new Measurement())
            ->setUrl(uniqid() . '.com')
            ->setTime($value);
    }
}