<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishReadme extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'readme';

    public $description = 'Publie le fichier README.md';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du fichuer README.md        
        $this->comment('Publication du fichier README.md');
        $file_origin = StarterKit::PATH_PUBLISH_README . 'laravel.yml';
        $destination = base_path('.github/workflows/laravel.yml');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication du fichier laravel.yml réussis !');

        return self::SUCCESS;
    }
}
