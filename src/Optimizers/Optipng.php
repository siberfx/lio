<?php

namespace Bvtterfly\Lio\Optimizers;

use Bvtterfly\Lio\Image;

class Optipng extends WithOptionsOptimizer
{
    public string $binaryName = 'optipng';

    public function canHandle(Image $image): bool
    {
        return $image->mime() === 'image/png';
    }
}
