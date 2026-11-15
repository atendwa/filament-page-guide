<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPreparedSets(deadCode: true, codeQuality: true, typeDeclarations: true, earlyReturn: true)
    ->withPaths([__DIR__ . '/src', __DIR__ . '/tests'])
    ->withImportNames()
    ->withPhpSets();
