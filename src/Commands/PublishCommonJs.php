<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;
use config\Starter;

class PublishCommonJs extends Command
{
    /* php artisan [signature] */
    public $signature = Starter::PREFIX_CMD . 'commonJs';

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

        // Publish common files
        $this->comment('Publications des fichiers communs');
        $folder_origin = Starter::RESOURCES_PATH . 'views/commun';
        $destination = resource_path('views/commun');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Fichiers publiés');
        $this->comment('Regenerate the optimized Composer autoloader files.');
        $this->composer->dumpOptimized();
        $this->comment('Publication réussi !');

        return self::SUCCESS;
    }
}
