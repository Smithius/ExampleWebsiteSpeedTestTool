<?php declare(strict_types=1);

use Rules\IsFaster;
use Rules\IsTwiceFaster;

class RulesTest extends BaseTestCase
{
    public function testIsSlower(): void
    {
        $firstMeasurement = $this->generateMeasurement(2);
        $secondMeasurement = $this->generateMeasurement(0.5);
        $thirdMeasurement = $this->generateMeasurement(2.5);

        $isFasterRule = new IsFaster();

        $this->assertFalse($isFasterRule->isValid($firstMeasurement, $secondMeasurement));
        $this->assertFalse($isFasterRule->isValid($thirdMeasurement, $firstMeasurement));
        $this->assertTrue($isFasterRule->isValid($firstMeasurement, $thirdMeasurement));
        $this->assertTrue($isFasterRule->isValid($secondMeasurement, $firstMeasurement));
    }

    public function testIsTwiceSlower(): void
    {
        $firstMeasurement = $this->generateMeasurement(2);
        $secondMeasurement = $this->generateMeasurement(0.5);
        $thirdMeasurement = $this->generateMeasurement(2.5);

        $isTwiceFasterRule = new IsTwiceFaster();
        $this->assertFalse($isTwiceFasterRule->isValid($firstMeasurement, $secondMeasurement));
        $this->assertTrue($isTwiceFasterRule->isValid($firstMeasurement, $thirdMeasurement));
    }
}
