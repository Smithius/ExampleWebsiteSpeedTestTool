<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Benchmarks\TestCase as BenchmarkTestCase;
use Benchmarks\TestRunner;
use Rules\IsSlower;
use Rules\IsTwiceSlower;
use Notifications\Email;
use Notifications\Sms;
use Entities\Report;

class BenchmarkTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $firstMeasurement = $this->generateMeasurement(2);
        $secondMeasurement = $this->generateMeasurement(0.5);
        $report = new Report($firstMeasurement, [$secondMeasurement]);

        $emailMock = $this->mockNotificationClass(Email::class);
        $smsMock = $this->mockNotificationClass(Sms::class);

        $tr = (new TestRunner($report))
            ->addTest(
                (new BenchmarkTestCase())
                    ->addRule(new IsSlower())
                    ->addNotification($emailMock)
            )
            ->addTest(
                (new BenchmarkTestCase())
                    ->addRule(new IsTwiceSlower())
                    ->addNotification($smsMock)
            );

        $tr->run();
    }

    private function generateMeasurement(float $value)
    {
        return new \Entities\Measurement(uniqid() . '.com', $value);
    }

    private function mockNotificationClass(string $notification)
    {
        $mock = $this->createMock($notification);
        $mock->expects($this->once())
            ->method('notify');

        return $mock;
    }
}
