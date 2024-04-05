<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishEnv extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'env';

    public $description = 'Publie les fichiers .env';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication des fichiers .env
        $this->comment('Publication des fichier .env');
        $folder_origin = StarterKit::PATH_PUBLISH_ENV;
        $destination = base_path();
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Publication des fichiers .env réussis !');

        return self::SUCCESS;
    }
}
