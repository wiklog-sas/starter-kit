<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishStubs extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'stubs';

    public $description = 'Publie le répertoire commun';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publish stubs files
        $this->comment('Publications des fichiers stubs');
        $folder_origin = StarterKit::PATH_PUBLISH_STUBS.'stubs';
        $destination = base_path('stubs');
        $file_system->copyDirectory($folder_origin, $destination);

        // Publish sh file
        $this->comment('Publications du fichier sh');
        $file_origin = StarterKit::PATH_PUBLISH_STUBS.'sh/newModel.sh';
        $destination = base_path();
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication réussi !');

        return self::SUCCESS;
    }
}
