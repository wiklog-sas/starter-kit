<?php

namespace Wiklog\StarterKit;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wiklog\StarterKit\Commands\PublishCommonJs;
use Wiklog\StarterKit\Commands\PublishComponents;

class StarterKitServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('starter-kit')
            // ->hasConfigFile('starter-kit')
            // ->hasMigration('create_starter-kit_table')
            ->hasCommand(PublishComponents::class)
            ->hasCommand(PublishCommonJs::class);
    }
}
