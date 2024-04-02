<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishPint extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'pint';

    public $description = 'Installe et configure laravel/pint';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        $this->composer->requirePackages(['laravel/pint'], true);

        // Publication du fichier de configuration
        $this->comment('Publication du fichier de configuration');
        $file_origin = StarterKit::PATH_PUBLISH_PINT . 'pint.json';
        $destination = base_path('pint.json');
        $file_system->copy($file_origin, $destination);

        $this->comment('Installation et configuration de laravel/pint réussi !');

        return self::SUCCESS;
    }
}
