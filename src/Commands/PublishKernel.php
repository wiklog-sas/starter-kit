<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishKernel extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'kernel';

    public $description = 'Publie un kernel modifier pour faire les variables de sessions correctement';

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
        $this->comment('Publication du fichier Kernel.php');
        $file_origin = StarterKit::PATH_PUBLISH_KERNEL . 'Kernel.php';
        $destination = app_path('Http/Kernel.php');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication du fichier Kernel.php réussis !');

        return self::SUCCESS;
    }
}
