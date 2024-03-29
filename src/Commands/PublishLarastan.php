<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishLarastan extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'larastan';

    public $description = 'Installe larastan et son fichier de configuration';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Installation insights
        $this->comment('Installation de larastan');
        $this->composer->requirePackages(['larastan/larastan'], true);

        // Publication du fichier de configuration
        $file_origin = StarterKit::PATH_PUBLISH_LARASTAN.'phpstan.neon';
        $destination = base_path('phpstan.neon');

        $file_system->copy($file_origin, $destination);

        $this->comment('Publication de larastan réussi !');

        return self::SUCCESS;
    }
}
