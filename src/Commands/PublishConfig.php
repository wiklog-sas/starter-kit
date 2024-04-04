<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishConfig extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'config';

    public $description = 'Publie le fichier de configuration app.php de laravel';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du kernel
        $this->info('Publication du fichier app.php');
        $file_origin = StarterKit::PATH_PUBLISH_CONFIG . 'app.php';
        $destination = config_path('app.php');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication du fichier app.php réussis !');

        return self::SUCCESS;
    }
}
