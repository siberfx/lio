<?php

use Bvtterfly\Lio\DummyLogger;
use Bvtterfly\Lio\OptimizerChain;
use Bvtterfly\Lio\OptimizerChainFactory;
use Bvtterfly\Lio\Optimizers\Jpegoptim;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;

it('gets a dummy logger', function () {
    Config::set('lio.log_optimizer_activity', false);
    $optimizerChain = OptimizerChainFactory::create(Config::get('lio'));
    expect($optimizerChain->getLogger())
        ->toBeInstanceOf(DummyLogger::class)
    ;
});

it('create a logger from class', function () {
    Config::set('lio.log_optimizer_activity', DummyLogger::class);
    $optimizerChain = OptimizerChainFactory::create(Config::get('lio'));
    expect($optimizerChain->getLogger())
        ->toBeInstanceOf(Psr\Log\LoggerInterface::class)
    ;
});

it('create optimizer chain with configured optimizers', function () {
    Config::set('lio.optimizers', []);
    $optimizerChain = OptimizerChainFactory::create(Config::get('lio'));
    expect($optimizerChain->getOptimizers())
        ->toHaveCount(0)
    ;

    Config::set('lio.optimizers', [Jpegoptim::class => []]);
    $optimizerChain = OptimizerChainFactory::create(Config::get('lio'));
    expect($optimizerChain->getOptimizers())
        ->toHaveCount(1)
        ->sequence(
            fn ($optimizer) => $optimizer->toBeInstanceOf(Jpegoptim::class),
        )
    ;
});

it('create optimizer chain with configured filesystem disk', function () {
    $optimizerChain = OptimizerChainFactory::create(Config::get('lio'));
    expect($optimizerChain->getFilesystem())
        ->toBeInstanceOf(Filesystem::class)
    ;

    Config::set('lio.optimizers', [Jpegoptim::class => []]);
    $optimizerChain = OptimizerChainFactory::create(Config::get('lio'));
    expect($optimizerChain->getOptimizers())
        ->toHaveCount(1)
        ->sequence(
            fn ($optimizer) => $optimizer->toBeInstanceOf(Jpegoptim::class),
        )
    ;
});

it('will throw an exception with a misconfigured optimizer', function () {
    Config::set('lio.optimizers', [stdClass::class => []]);
    app(OptimizerChain::class);
})->throws(\Bvtterfly\Lio\Exceptions\InvalidConfiguration::class);

it('will throw an exception with a misconfigured logger', function () {
    Config::set('lio.log_optimizer_activity', stdClass::class);
    app(OptimizerChain::class);
})->throws(\Bvtterfly\Lio\Exceptions\InvalidConfiguration::class);
