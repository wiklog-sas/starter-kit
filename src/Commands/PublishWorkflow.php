<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishWorkflow extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'workflow';

    public $description = 'Publie le fichier laravel.yml pour le workflow sur GitHub Action';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du kernel
        $this->comment('Publication du fichier laravel.yml');
        $file_origin = StarterKit::PATH_PUBLISH_WORKFLOW . 'laravel.yml';
        $destination = base_path('.github/workflows/laravel.yml');
        $this->createDirIfNotExists(base_path('.github/workflows'));
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication du fichier laravel.yml réussis !');

        return self::SUCCESS;
    }

    /**
     * Créer un dossier s'il n'existe pas
     *
     * @param  string  $path
     * @return void
     */
    public function createDirIfNotExists(string $path): void
    {
        $file_system = new Filesystem();
        if (! $file_system->exists($path)) {
            $file_system->makeDirectory($path, recursive: true);
        }
    }
}
