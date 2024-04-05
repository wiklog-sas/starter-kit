<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishPhpUnit extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'phpunit';

    public $description = 'Installe et configure phpunit';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        $this->info('Installation de phpunit/phpunit');
        $this->composer->requirePackages(['phpunit/phpunit'], true);

        // Publication du fichier de configuration
        $this->comment('Publication du fichier de configuration');
        $file_origin = StarterKit::PATH_PUBLISH_PHP_UNIT . 'phpunit.xml';
        $destination = base_path('phpunit.xml');
        $file_system->copy($file_origin, $destination);

        $this->comment('Installation et configuration de phpunit/phpunit réussis !');

        return self::SUCCESS;
    }
}
