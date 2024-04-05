<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishIdeHelper extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'ide_helper';

    public $description = 'Installe ide_helper';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Installation ide helper
        $this->comment('Installation de ide helper');
        $this->composer->requirePackages(['barryvdh/laravel-ide-helper'], true);
        $this->comment('Publication de ide helper réussis !');

        return self::SUCCESS;
    }
}
