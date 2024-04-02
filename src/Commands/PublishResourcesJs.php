<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishResourcesJs extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'resourcesJs';

    public $description = 'Publie les fichiers resources javascripts';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication des resources JS
        $this->comment('Publications des resources javascripts');
        $folder_origin = StarterKit::PATH_PUBLISH_RESOURCES_JS;
        $destination = resource_path('js');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Publication des resources javascripts réussis !');

        return self::SUCCESS;
    }
}
