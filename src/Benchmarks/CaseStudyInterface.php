<?php declare(strict_types=1);

namespace Benchmarks;

use Entities\Measurement;
use Entities\MeasureReport;
use Notifications\NotificationInterface;
use Rules\RuleInterface;

interface CaseStudyInterface
{
    public function addRule(RuleInterface $rule): CaseStudyInterface;

    public function addNotification(NotificationInterface $notification): CaseStudyInterface;

    public function test(Measurement $testedWebsite, Measurement $comparedWebsites): ?array;

    public function notify(MeasureReport $report, ?array $brokenRules): void;
}
