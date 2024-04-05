<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishExtendBlueprint extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'blueprint';

    public $description = 'Publie le fichier ExtendBlueprint.php pour les migrations de création de table';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du fichier ExtendBlueprint.php
        $file_origin = StarterKit::PATH_PUBLISH_EXTEND_BLUEPRINT.'ExtendBlueprint.php';
        $destination = app_path('Classes/Commun/ExtendBlueprint.php');
        $this->createDirIfNotExists(app_path('Classes/Commun'));
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication du fichier ExtendBlueprint.php réussis !');

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
