<?php

declare(strict_types=1);

namespace MFApps\Shared;

use Assert\Assertion as BaseAssertion;
use MFApps\Shared\Exception\InvalidAssertionException;

final class Assertion extends BaseAssertion
{
    protected static $exceptionClass = InvalidAssertionException::class;
}
