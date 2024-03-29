<?php

namespace Wiklog\StarterKit;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wiklog\StarterKit\Commands\PublishCommonJs;
use Wiklog\StarterKit\Commands\PublishComponents;
use Wiklog\StarterKit\Commands\PublishDump;
use Wiklog\StarterKit\Commands\PublishIdeHelper;
use Wiklog\StarterKit\Commands\PublishInsights;
use Wiklog\StarterKit\Commands\PublishLarastan;
use Wiklog\StarterKit\Commands\PublishLibrairiesMigration;
use Wiklog\StarterKit\Commands\PublishPdfMulticell;
use Wiklog\StarterKit\Commands\PublishStubs;
use Wiklog\StarterKit\Commands\PublishWebfonts;

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
            ->hasCommand(PublishCommonJs::class)
            ->hasCommand(PublishComponents::class)
            ->hasCommand(PublishDump::class)
            ->hasCommand(PublishIdeHelper::class)
            ->hasCommand(PublishInsights::class)
            ->hasCommand(PublishLarastan::class)
            ->hasCommand(PublishLibrairiesMigration::class)
            ->hasCommand(PublishPdfMulticell::class)
            ->hasCommand(PublishStubs::class)
            ->hasCommand(PublishWebfonts::class);

    }
}
