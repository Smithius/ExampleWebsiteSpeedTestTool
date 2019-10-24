<?php declare(strict_types=1);

namespace Rules;

use Entities\Measurement;

class IsFaster implements RuleInterface
{
    const MULTIPLIER = 1;

    public function isValid(Measurement $testPage, Measurement $comparedPage): bool
    {
        return $testPage->getTime() <= ($comparedPage->getTime() * static::MULTIPLIER);
    }

    public function getName(): string
    {
        return static::class;
    }
}
