<?php declare(strict_types=1);

namespace Notifications;

use Entities\Report;

interface NotificationInterface
{
    public function notify(Report $report): void;
}
