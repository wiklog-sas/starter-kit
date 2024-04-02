<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Wiklog\StarterKit\StarterKit;

class PublishHelpers extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'helpers';

    public $description = 'Publie le fichier helpers.php';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du fichier helpers.php
        $file_origin = StarterKit::PATH_PUBLISH_HELPERS.'helpers.php';
        $destination = app_path('Classes/Commun/helpers.php');
        $file_system->copy($file_origin, $destination);

        $this->addAutoloadDevHelpers();
        $this->comment('Regenerate the Composer autoloader files.');
        $this->composer->dumpAutoloads();

        $this->comment('Publication du fichier helpers.php réussis !');

        return self::SUCCESS;
    }

    public function addAutoloadDevHelpers()
    {
        $autoload_path = 'app/Classes/Commun/helpers.php';
        $composer_path = base_path('composer.json');
        $composer_content = File::get($composer_path);
        $composer_config = json_decode($composer_content, true);

        if (! isset($composer_config['autoload-dev'])) {
            $composer_config['autoload-dev'] = ['files' => []];
        } elseif (!isset($composer_config['autoload-dev']['files'])) {
            $composer_config['autoload-dev']['files'] = [];
        }

        if (! in_array($autoload_path, $composer_config['autoload-dev']['files'])) {
            $composer_config['autoload-dev']['files'][] = $autoload_path;

            $updated_composer_content = json_encode($composer_config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            File::put($composer_path, $updated_composer_content);

            $this->comment('Ajout du fichier helpers.php en autoload-dev: files !');
        } else {
            $this->warn('Le fichier helpers.php existe déjà en autoload-dev: files !');
        }
    }
}
