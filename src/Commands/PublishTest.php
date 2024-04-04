<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;
use Illuminate\Support\Facades\Artisan;

class PublishTest extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'test';

    public $description = 'commande pour les tests de devs';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        shell_exec('php artisan vendor:publish --provider="NunoMaduro\PhpInsights\Application\Adapters\Laravel\InsightsServiceProvider"');
        Artisan::call('key:generate');

        return self::SUCCESS;
    }
}
