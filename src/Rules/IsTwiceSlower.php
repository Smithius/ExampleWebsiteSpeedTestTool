<?php declare(strict_types=1);

namespace Rules;

class IsTwiceSlower extends IsSlower
{
    /**
     * @var int
     */
    protected $multiplier = 2;
}
