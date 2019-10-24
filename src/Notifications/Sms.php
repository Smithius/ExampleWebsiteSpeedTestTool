<?php declare(strict_types=1);

namespace Notifications;

use Entities\MeasureReport;

class Sms implements NotificationInterface
{
    public function notify(MeasureReport $report, ?array $brokenRules): void
    {
        // SMS >>>
    }
}
