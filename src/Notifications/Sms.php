<?php declare(strict_types=1);

namespace Notifications;

use Entities\Report;

class Sms implements NotificationInterface
{
    public function notify(Report $report): void
    {
        // SMS >>>
    }
}
