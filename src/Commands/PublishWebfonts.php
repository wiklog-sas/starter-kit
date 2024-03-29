<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishWebfonts extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'webfonts';

    public $description = 'Publie les webfonts';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication des webfonts
        $this->comment('Publications des webfonts');
        $folder_origin = StarterKit::PATH_PUBLISH_WEBFONTS;
        $destination = public_path('webfonts');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Publication des webfonts réussi !');

        return self::SUCCESS;
    }
}
