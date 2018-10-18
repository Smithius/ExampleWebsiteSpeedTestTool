<?php declare(strict_types=1);

namespace Notifications;

use Entities\Report;

class Email implements NotificationInterface
{
    public function notify(Report $report): void
    {
        // send email probably by SwiftMailer
        // probably also you will need some config here
    }
}
