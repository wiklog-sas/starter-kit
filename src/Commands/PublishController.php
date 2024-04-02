<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishController extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'controller';

    public $description = 'Publie le controller avec la méthode can()';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du controller
        $this->comment('Publications du controller');
        $file_origin = StarterKit::PATH_PUBLISH_CONTROLLER . 'Controller.php';
        $destination = app_path('Http/Controller/Controller.php');
        $file_system->copy($file_origin, $destination);

        $this->comment('Controlleur publié !');

        return self::SUCCESS;
    }
}
