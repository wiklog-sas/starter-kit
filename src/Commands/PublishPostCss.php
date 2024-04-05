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

    public $description = 'Supprime le postcss.config.js et créé le fichier postcss.config.cjs';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Suppression du postcss.config.js
        if ($file_system->exists(base_path('postcss.config.js'))) {
            $file_system->delete(base_path('postcss.config.js'));
        }

        // Publication du postcss.config.cjs
        $file_origin = StarterKit::PATH_PUBLISH_POSTCSS . 'postcss.config.cjs';
        $destination = base_path('postcss.config.cjs');
        $file_system->copy($file_origin, $destination);
        

        $this->comment('Publication du fichier postcss.config.cjs réussis !');

        return self::SUCCESS;
    }
}
