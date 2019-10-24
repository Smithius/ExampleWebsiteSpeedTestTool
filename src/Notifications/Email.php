<?php declare(strict_types=1);

namespace Notifications;

use Entities\MeasureReport;

class Email implements NotificationInterface
{
    public function notify(MeasureReport $report, ?array $brokenRules): void
    {
        // send email probably by SwiftMailer
        // probably also you will need some config here
    }
}
