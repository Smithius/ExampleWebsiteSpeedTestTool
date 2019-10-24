<?php declare(strict_types=1);

namespace Rules;

use Entities\Measurement;

interface RuleInterface
{
    public function isValid(Measurement $testPage, Measurement $comparedPage): bool;

    public function getName(): string;
}
