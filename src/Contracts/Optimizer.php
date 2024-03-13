<?php

namespace Bvtterfly\Lio\Contracts;

use Psr\Log\LoggerInterface;

interface Optimizer
{
    /**
     * Determines if the given image can be handled by the optimizer.
     */
    public function canHandle(Image $image): bool;

    /**
     * Sets the path to the image that should be optimized.
     */
    public function setImagePath(string $imagePath): self;

    /**
     * Sets the logger for logging optimization process.
     */
    public function setLogger(LoggerInterface $logger): self;

    /**
     * Sets the amount of seconds optimizer may use.
     */
    public function setTimeout(int $timeout): self;

    /**
     * Runs the optimizer.
     */
    public function run(): void;
}
