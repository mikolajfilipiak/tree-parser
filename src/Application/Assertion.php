<?php

declare(strict_types=1);

namespace MFApps\Application;

use Assert\Assertion as BaseAssertion;
use MFApps\Application\Exception\InvalidAssertionException;

final class Assertion extends BaseAssertion
{
    protected static $exceptionClass = InvalidAssertionException::class;
}
