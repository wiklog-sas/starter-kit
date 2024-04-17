<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class PublishEnv extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'env';

    public $description = 'Publie les fichiers .env';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication des fichiers .env
        $this->comment('Publication des fichier .env');
        $folder_origin = StarterKit::PATH_PUBLISH_ENV;
        $destination = base_path();
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Publication des fichiers .env réussis !');

        $this->info('Génération de la clé de l’application');
        Artisan::call('key:generate');
        $this->comment('Pensez à l’ajouter aussi pour le .env.testing');
        $this->composer->dumpOptimized();
        $this->composer->dumpAutoloads();
        Artisan::call('config:cache');
        
        $this->comment('Configurer les puis exécuter la commande : artisan starter:init');

        $this->info('Vagrant doit être lancer en mode admin et les commandes aussi dans le terminal windows');

        return self::SUCCESS;
    }
}
