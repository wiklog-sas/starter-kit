<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishPostCss extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'postcss';

    public $description = 'Renomme postcss.config.js en postcss.config.cjs';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du postcss.config.cjs
        $this->comment('Publication du fichier laravel.yml');
        if ($file_system->exists(base_path('postcss.config.js'))) {
            $file_origin = base_path('postcss.config.js');
            $new_name = base_path('postcss.config.cjs');
            $file_system->rename($file_origin, $new_name);
        } else {
            $this->warn('Le fichier postcss.config.js n’existe pas, création du fichier postcss.config.cjs');

            $file_origin = StarterKit::PATH_PUBLISH_POSTCSS . 'postcss.config.cjs';
            $destination = base_path('postcss.config.cjs');
            $file_system->copy($file_origin, $destination);
        }

        $this->comment('Publication du fichier postcss.config.cjs réussis !');

        return self::SUCCESS;
    }
}
