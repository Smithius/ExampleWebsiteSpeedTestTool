<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class RulesTest extends TestCase
{
    public function testIsSlower()
    {
        $first = new \Entities\Measurement('xxx', 2);
        $second = new \Entities\Measurement('yyy', 0.5);
        $third = new \Entities\Measurement('zzz', 2.5);
        $rule = new \Rules\IsSlower();

        $this->assertTrue($rule->check($first, $second));
        $this->assertFalse($rule->check($first, $third));
    }

    public function testIsTwiceSlower()
    {
        $first = new \Entities\Measurement('xxx', 2);
        $second = new \Entities\Measurement('yyy', 0.5);
        $third = new \Entities\Measurement('zzz', 2.5);
        $rule = new \Rules\IsTwiceSlower();

        $this->assertTrue($rule->check($first, $second));
        $this->assertFalse($rule->check($first, $third));
    }
}
