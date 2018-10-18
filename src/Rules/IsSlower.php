<?php declare(strict_types=1);

namespace Rules;

use Entities\Measurement;

class IsSlower implements RuleInterface
{
    /**
     * @var int
     */
    protected $multiplier = 1;

    function check(Measurement $testPage, Measurement $comparedPage): bool
    {
        return $testPage->getTime() > $comparedPage->getTime() * $this->multiplier;
    }
}
