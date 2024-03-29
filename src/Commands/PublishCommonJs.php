<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishCommonJs extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'commun';

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
        $folder_origin = StarterKit::PATH_PUBLISH_COMMUN;
        $destination = resource_path('views/commun');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Fichiers publiés');

        return self::SUCCESS;
    }
}
