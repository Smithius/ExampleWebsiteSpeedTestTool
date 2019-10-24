<?php declare(strict_types=1);

namespace Benchmarks;

use Rules\RuleInterface;
use Notifications\NotificationInterface;
use Entities\Measurement;
use Entities\MeasureReport;

class CaseStudy implements CaseStudyInterface
{
    /**
     * @var RuleInterface[]
     */
    private $rules = [];

    /**
     * @var NotificationInterface[]
     */
    private $notifications = [];

    public function addRule(RuleInterface $rule): CaseStudyInterface
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function addNotification(NotificationInterface $notification): CaseStudyInterface
    {
        $this->notifications[] = $notification;

        return $this;
    }

    public function test(Measurement $testedWebsite, Measurement $comparedWebsite): ?array
    {
        $brokenRules = [];
        foreach ($this->rules as $rule) {
            if (!$rule->isValid($testedWebsite, $comparedWebsite)) {
                $brokenRules[] = $rule;
            }
        }

        return !empty($brokenRules) ? $brokenRules : null;
    }

    public function notify(MeasureReport $report, ?array $brokenRules): void
    {
        foreach ($this->notifications as $notify) {
            $notify->notify($report, $brokenRules);
        }
    }
}
