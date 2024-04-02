<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Wiklog\StarterKit\StarterKit;

class PublishGit extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'git';

    public $description = 'Publie le fichier .gitignore et .gitattributes';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        $this->comment('Publication du fichier .gitignore et .gitattributes');
        $file_origin = StarterKit::PATH_PUBLISH_GIT;
        $destination = base_path();
        $file_system->copyDirectory($file_origin, $destination);

        $this->comment('Publication du fichier .gitignore et .gitattributes réussis !');

        return self::SUCCESS;
    }
}
