<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class PublishInputsComponents extends Command
{
    /* php artisan [signature] */
    public $signature = 'wiklog-inputs-components:publish';

    public $description = 'Publie et crée les différents composants dans le projet Laravel';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        //Publish Inputs classes
        $this->comment('Publications des fichiers de classe des composants');
        $folder_origin = __DIR__.'/../../resources/classes/Inputs';
        $destination = app_path('View/Components/Inputs');
        $file_system->copyDirectory($folder_origin, $destination);

        //Publish Inputs views
        $this->comment('Publications des composants blade');
        $folder_origin = __DIR__.'/../../resources/views/components';
        $destination = resource_path('views/components');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Composants publiés');
        $this->comment('Regenerate the optimized Composer autoloader files.');
        $this->composer->dumpOptimized();
        $this->comment('Package installé !');

        return self::SUCCESS;
    }
}
