<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;
use Wiklog\StarterKit\StarterKitServiceProvider;

class PublishCommonJs extends Command
{
    /* php artisan [signature] */
    public $signature = 'starter:help';

    public $description = 'Affiche la liste des commandes';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $this->info('Liste des commandes :');

        $test = array_keys(app()->getCommands());
        foreach ($test as $command) {
            $this->line($command);
        }
        return self::SUCCESS;
    }
}
