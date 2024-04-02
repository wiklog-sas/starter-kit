<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;
use Illuminate\Support\Facades\Artisan;

class PublishBouncer extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'bouncer';

    public $description = 'Installe et configure silber/bouncer';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        $this->comment('Installation de silber/bouncer');
        $this->composer->requirePackages(['silber/bouncer']);

        // Publication du kernel
        $this->comment('Publication de la migration');
        Artisan::call('vendor:publish --tag="bouncer.migrations"');

        // Publication de User
        $this->comment('Publication du model User.php');
        $file_origin = StarterKit::PATH_PUBLISH_BOUNCER . 'User.php';
        $destination = app_path('Models/User.php');
        $file_system->copy($file_origin, $destination);

        Artisan::call('migrate');

        $this->comment('Installation de Bouncer et publication de la migration réussis !');

        return self::SUCCESS;
    }
}
