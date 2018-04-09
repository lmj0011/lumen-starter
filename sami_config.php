<?php

// https://github.com/FriendsOfPHP/Sami

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir = './app')
;


return new Sami($iterator, array(
    'title'                => 'My Lumen 5.6 API',
    'cache_dir'            => __DIR__.'/docs/api/sami-cache',
    'build_dir'            => __DIR__.'/docs/api/app',
    'default_opened_level' => 1,
));