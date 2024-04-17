<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishLogo extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'logo';

    public $description = 'Publie le logo wiklog';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du logo
        $this->comment('Publication du fichier logo.png');
        $file_origin = StarterKit::PATH_PUBLISH_LOGO . 'logo.png';
        $destination = public_path('logo.png');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication du fichier logo.png réussis !');

        return self::SUCCESS;
    }
}
