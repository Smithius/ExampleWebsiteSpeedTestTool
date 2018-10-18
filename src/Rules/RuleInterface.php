<?php declare(strict_types=1);

namespace Rules;

use Entities\Measurement;

interface RuleInterface
{
    public function check(Measurement $testPage, Measurement $comparedPage): bool;
}
