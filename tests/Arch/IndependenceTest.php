<?php

declare(strict_types=1);

arch('the package depends on nothing from an application')
    ->expect('Atendwa\PageGuide')
    ->not->toUse(['App']);
