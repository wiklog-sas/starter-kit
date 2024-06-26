<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Wiklog\StarterKit\StarterKit;

class PublishNpmVite extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'npmVite';

    public $description = 'Installe et configure npm et vite';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Suppression du répertoire node_modules
        shell_exec('rm -rf node_modules');

        // Publication du fichier packages.json
        $this->comment('Publication du fichier packages.json');
        $file_origin = StarterKit::PATH_PUBLISH_NPM_VITE . 'packages';
        $destination = base_path();
        $file_system->copyDirectory($file_origin, $destination);

        $this->comment('Publication du fichier packages.json réussis !');

        $this->comment('Publication du fichier vite.config.js');
        $file_origin = StarterKit::PATH_PUBLISH_NPM_VITE . 'vite/vite.config.js';
        $destination = base_path('vite.config.js');
        $file_system->copy($file_origin, $destination);

        $this->info('Installation de npm');
        shell_exec('npm install');
        $this->info('npm run build');
        shell_exec('npm run build');

        return self::SUCCESS;
    }
}
