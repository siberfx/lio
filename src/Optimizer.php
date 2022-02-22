<?php

namespace Bvtterfly\Lio;

interface Optimizer
{
    /**
     * Returns the name of the binary to be executed.
     *
     * @return string
     */
    public function binaryName(): string;

    /**
     * Determines if the given image can be handled by the optimizer.
     *
     * @param Image $image
     *
     * @return bool
     */
    public function canHandle(Image $image): bool;

    /**
     * Sets the path to the image that should be optimized.
     *
     * @param string $imagePath
     *
     * @return $this
     */
    public function setImagePath(string $imagePath);

    /**
     * Sets the options the optimizer should use.
     *
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options = []);

    /**
     * Gets the command that should be executed.
     *
     * @return string
     */
    public function getCommand(): string;
}
