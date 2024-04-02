<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishResourcesScss extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'resourcesScss';

    public $description = 'Publie les fichiers resources scss';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication des resources SCSS
        $this->comment('Publications des resources scss');
        $folder_origin = StarterKit::PATH_PUBLISH_RESOURCES_SCSS;
        $destination = resource_path('scss');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Publication des resources scss réussi !');

        return self::SUCCESS;
    }
}
