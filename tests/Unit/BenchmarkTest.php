<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Benchmarks\TestCase as BenchmarkTestCase;
use Benchmarks\TestRunner;
use Rules\IsSlower;
use Rules\IsTwiceSlower;
use Notifications\Email;
use Notifications\Sms;

class BenchmarkTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $first = new \Entities\Measurement('xxx', 2);
        $second = new \Entities\Measurement('yyy', 0.5);
        $report = new \Entities\Report($first, [$second]);

        $mockValidEmail = $this->createMock(Email::class);
        $mockValidEmail->expects($this->once())
            ->method('notify');

        $mockValidSms = $this->createMock(Sms::class);
        $mockValidSms->expects($this->once())
            ->method('notify');


        $tr = (new TestRunner($report))
            ->addTest(
                (new BenchmarkTestCase())
                    ->addRule(new IsSlower())
                    ->addNotification($mockValidEmail)
            )
            ->addTest(
                (new BenchmarkTestCase())
                    ->addRule(new IsTwiceSlower())
                    ->addNotification($mockValidSms)
            );

        $tr->run();
    }
}



