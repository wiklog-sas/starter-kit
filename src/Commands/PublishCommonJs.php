<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class PublishCommonJs extends Command
{
    /* php artisan [signature] */
    public $signature = 'starter:commonJs';

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

        // Publish components classes
        $this->comment('Publications des fichiers communs');
        $folder_origin = __DIR__.'/../../resources/views/commun';
        $destination = resource_path('views/commun');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Fichiers publiés');
        $this->comment('Regenerate the optimized Composer autoloader files.');
        $this->composer->dumpOptimized();
        $this->comment('Publication réussi !');

        return self::SUCCESS;
    }
}
