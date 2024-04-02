<?php

namespace Wiklog\StarterKit;

use Spatie\LaravelPackageTools\Package;
use Wiklog\StarterKit\Commands\PublishGit;
use Wiklog\StarterKit\Commands\PublishAuth;
use Wiklog\StarterKit\Commands\PublishDump;
use Wiklog\StarterKit\Commands\PublishPint;
use Wiklog\StarterKit\Commands\PublishStubs;
use Wiklog\StarterKit\Commands\PublishKernel;
use Wiklog\StarterKit\Commands\PublishTraits;
use Wiklog\StarterKit\Commands\PublishHelpers;
use Wiklog\StarterKit\Commands\PublishCommonJs;
use Wiklog\StarterKit\Commands\PublishInsights;
use Wiklog\StarterKit\Commands\PublishLarastan;
use Wiklog\StarterKit\Commands\PublishWebfonts;
use Wiklog\StarterKit\Commands\PublishIdeHelper;
use Wiklog\StarterKit\Commands\PublishComponents;
use Wiklog\StarterKit\Commands\PublishController;
use Wiklog\StarterKit\Commands\PublishResourcesJs;
use Wiklog\StarterKit\Commands\PublishEditorConfig;
use Wiklog\StarterKit\Commands\PublishPdfMulticell;
use Wiklog\StarterKit\Commands\PublishResourcesScss;
use Wiklog\StarterKit\Commands\PublishResourcesViews;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wiklog\StarterKit\Commands\PublishBouncer;
use Wiklog\StarterKit\Commands\PublishCrudTemplate;
use Wiklog\StarterKit\Commands\PublishEnv;
use Wiklog\StarterKit\Commands\PublishExtendBlueprint;
use Wiklog\StarterKit\Commands\PublishLibrairiesMigration;
use Wiklog\StarterKit\Commands\PublishNpmVite;
use Wiklog\StarterKit\Commands\PublishPhpUnit;
use Wiklog\StarterKit\Commands\PublishPostCss;
use Wiklog\StarterKit\Commands\PublishReadme;
use Wiklog\StarterKit\Commands\PublishWorkflow;

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
            ->hasCommand(PublishAuth::class)
            ->hasCommand(PublishBouncer::class)
            ->hasCommand(PublishCommonJs::class)
            ->hasCommand(PublishComponents::class)
            ->hasCommand(PublishCrudTemplate::class)
            ->hasCommand(PublishController::class)
            ->hasCommand(PublishDump::class)
            ->hasCommand(PublishEditorConfig::class)
            ->hasCommand(PublishEnv::class)
            ->hasCommand(PublishExtendBlueprint::class)
            ->hasCommand(PublishGit::class)
            ->hasCommand(PublishHelpers::class)
            ->hasCommand(PublishIdeHelper::class)
            ->hasCommand(PublishInsights::class)
            ->hasCommand(PublishKernel::class)
            ->hasCommand(PublishLarastan::class)
            ->hasCommand(PublishNpmVite::class)
            ->hasCommand(PublishLibrairiesMigration::class)
            ->hasCommand(PublishPdfMulticell::class)
            ->hasCommand(PublishPhpUnit::class)
            ->hasCommand(PublishPint::class)
            ->hasCommand(PublishPostCss::class)
            ->hasCommand(PublishReadme::class)
            ->hasCommand(PublishResourcesJs::class)
            ->hasCommand(PublishResourcesScss::class)
            ->hasCommand(PublishResourcesViews::class)
            ->hasCommand(PublishStubs::class)
            ->hasCommand(PublishTraits::class)
            ->hasCommand(PublishWebfonts::class)
            ->hasCommand(PublishWorkflow::class);
    }
}
