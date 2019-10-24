<?php

namespace Exceptions;

use RuntimeException;

class UnmeasuredPageException extends RuntimeException implements PageSpeedTestException
{
}