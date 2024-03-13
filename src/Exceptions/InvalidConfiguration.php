<?php

namespace Bvtterfly\Lio\Exceptions;

use Bvtterfly\Lio\Contracts\Optimizer;
use Exception;
use Psr\Log\LoggerInterface;

final class InvalidConfiguration extends Exception
{
    public static function notAnOptimizer(string $class)
    {
        $optimizerInterface = Optimizer::class;

        return new self("Configured optimizer `{$class}` does not implement `{$optimizerInterface}`.");
    }

    public static function notAnLogger(string $class)
    {
        $loggerInterface = LoggerInterface::class;

        return new self("Configured optimizer `{$class}` does not implement `{$loggerInterface}`.");
    }
}
