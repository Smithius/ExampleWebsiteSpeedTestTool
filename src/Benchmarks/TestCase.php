<?php declare(strict_types=1);

namespace Benchmarks;

use Rules\RuleInterface;
use Notifications\NotificationInterface;
use Entities\Measurement;
use Entities\Report;

class TestCase
{
    /**
     * @var RuleInterface[]
     */
    private $rules = [];

    /**
     * @var NotificationInterface[]
     */
    private $notifications = [];

    /**
     * @var bool
     */
    private $comparisonResult = false;

    public function addRule(RuleInterface $rule): TestCase
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function addNotification(NotificationInterface $notification): TestCase
    {
        $this->notifications[] = $notification;

        return $this;
    }

    public function test(Measurement $testedWebsite, Measurement $comparedWebsites): bool
    {
        if (empty($this->rules)) {
            throw new Exception('No rules.');
        }

        $result = $this->checkRules($testedWebsite, $comparedWebsites);
        $this->comparisonResult = $this->comparisonResult || $result;

        return $result;
    }

    public function notify(Report $report): void
    {
        if ($this->comparisonResult) {
            foreach ($this->notifications as $notify) {
                $notify->notify($report);
            }
        }
    }

    private function checkRules(Measurement $testedWebsite, Measurement $comparedWebsites): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule->check($testedWebsite, $comparedWebsites)) {
                return false;
            }
        }

        return true;
    }
}
