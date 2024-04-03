<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishResourcesViews extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'resourcesViews';

    public $description = 'Publie les fichiers resources views';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication des resources views
        $this->comment('Publications des resources views');
        $folder_origin = StarterKit::PATH_PUBLISH_RESOURCES_VIEWS . 'views';
        $destination = resource_path('views');
        $file_system->copyDirectory($folder_origin, $destination);

        // Publication de accueil controller
        $this->comment('Publications du controller d’accueil');
        $file_origin = StarterKit::PATH_PUBLISH_RESOURCES_VIEWS . 'AccueilController.php';
        $destination = app_path('Http/Controllers/AccueilController.php');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication des resources views réussis !');

        return self::SUCCESS;
    }
}
