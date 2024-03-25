<?php

namespace Wiklog\StarterKit\Commands;

use DirectoryIterator;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\App;

class PublishInputsComponents extends Command
{
    public $signature = 'wiklog-inputs-components:publish';

    public $description = 'Publie et crée les différents composants dans le projet Laravel';

    public $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        //Publish Inputs classes
        $folder_origin = __DIR__.'/../../resources/classes/Inputs';
        $destination = app_path('View/Components/Inputs');
        $file_system->copyDirectory($folder_origin, $destination);

        //Publish Inputs views
        $folder_origin = __DIR__.'/../../resources/components/inputs/views';
        $destination = resource_path('views/components');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Composants inputs publiés');
        $this->comment('Regenerate the optimized Composer autoloader files.');
        $this->composer->dumpOptimized();
        $this->comment('Package installé !');

        return self::SUCCESS;
    }
}
