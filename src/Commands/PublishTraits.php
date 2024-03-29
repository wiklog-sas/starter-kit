<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishTraits extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'traits';

    public $description = 'Publie les traits';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication des traits
        $this->comment('Publications des triats');
        $folder_origin = StarterKit::PATH_PUBLISH_TRAITS;
        $destination = app_path('Traits');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Publication de traits réussi !');

        return self::SUCCESS;
    }
}
