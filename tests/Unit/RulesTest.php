<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class RulesTest extends TestCase
{
    public function testIsSlower()
    {
        $firstMeasurement = $this->generateMeasurement(2);
        $secondMeasurement = $this->generateMeasurement(0.5);
        $thirdMeasurement = $this->generateMeasurement(2.5);

        $rule = new \Rules\IsSlower();

        $this->assertTrue($rule->check($firstMeasurement, $secondMeasurement));
        $this->assertTrue($rule->check($thirdMeasurement, $firstMeasurement));
        $this->assertFalse($rule->check($firstMeasurement, $thirdMeasurement));
        $this->assertFalse($rule->check($secondMeasurement, $firstMeasurement));
    }

    public function testIsTwiceSlower()
    {
        $firstMeasurement = $this->generateMeasurement(2);
        $secondMeasurement = $this->generateMeasurement(0.5);
        $thirdMeasurement = $this->generateMeasurement(2.5);

        $rule = new \Rules\IsTwiceSlower();

        $this->assertTrue($rule->check($firstMeasurement, $secondMeasurement));
        $this->assertFalse($rule->check($firstMeasurement, $thirdMeasurement));
    }

    private function generateMeasurement(float $value)
    {
        return new \Entities\Measurement(uniqid() . '.com', $value);
    }
}
