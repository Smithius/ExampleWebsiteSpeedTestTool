<?php declare(strict_types=1);

namespace Notifications;

use Entities\MeasureReport;

interface NotificationInterface
{
    public function notify(MeasureReport $report, ?array $brokenRules): void;
}
