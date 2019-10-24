<?php declare(strict_types=1);

use Benchmarks\CaseStudy;
use Benchmarks\PageMeasurerInterface;
use Exceptions\UnmeasuredPageException;
use Notifications\NotificationInterface;
use Outputs\File;
use Rules\IsFaster;
use Rules\IsTwiceFaster;
use Notifications\Email;
use Notifications\Sms;

class PageSpeedToolTest extends BaseTestCase
{
    public function testInvalidBaseUrl(): void
    {
        $this->expectException(UnmeasuredPageException::class);

        $pageMeasurerMock = $this->mockPageMeasurer(null, $this->generateMeasurement(1));

        $this->generatePageSpeedTool($pageMeasurerMock)
            ->run('url', ['url2']);
    }

    public function testInvalidOtherUrls(): void
    {
        $this->expectException(UnmeasuredPageException::class);

        $pageMeasurerMock = $this->mockPageMeasurer($this->generateMeasurement(1), null);

        $this->generatePageSpeedTool($pageMeasurerMock)
            ->run('url', ['url2']);
    }

    public function testNotifications(): void
    {
        $pageMeasurerMock = $this->mockPageMeasurer(
            $this->generateMeasurement(2),
            $this->generateMeasurement(2.5),
            $this->generateMeasurement(0.5)
        );

        (new PageSpeedTool($pageMeasurerMock))
            ->addOutput(new File('test.log'))
            ->addCaseStudy(
                (new CaseStudy())
                    ->addRule(new IsFaster())
                    ->addNotification($this->mockNotificationClass(Email::class))
                    ->addNotification($this->mockNotificationClass(Sms::class))
            )
            ->run('url', ['url2', 'url3']);
    }

    private function generatePageSpeedTool(PageMeasurerInterface $pageMeasurerMock): PageSpeedTool
    {
        return (new PageSpeedTool($pageMeasurerMock))
            ->addOutput(new File('test.log'))
            ->addCaseStudy(
                (new CaseStudy())
                    ->addRule(new IsFaster())
                    ->addNotification(new Email())
            )
            ->addCaseStudy(
                (new CaseStudy())
                    ->addRule(new IsTwiceFaster())
                    ->addNotification(new Sms())
            );
    }

    private function mockPageMeasurer(...$consecutiveCalls): PageMeasurerInterface
    {
        $pageMeasurerMock = $this->createMock(PageMeasurerInterface::class);
        $pageMeasurerMock->method('measure')
            ->will($this->onConsecutiveCalls(
                ...$consecutiveCalls
            ));

        return $pageMeasurerMock;
    }

    private function mockNotificationClass(string $notification): NotificationInterface
    {
        $mock = $this->createMock($notification);
        $mock->expects($this->once())
            ->method('notify');

        return $mock;
    }
}
