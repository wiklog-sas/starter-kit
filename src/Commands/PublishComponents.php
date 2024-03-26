<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;
use Illuminate\Filesystem\Filesystem;

class PublishComponents extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_CMD.'components';

    public $description = 'Publie les composants dans le projet Laravel';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publish components classes
        $this->comment('Publications des fichiers de classe des composants');
        $folder_origin = __DIR__.'/../../resources/classes/Inputs';
        $destination = app_path('View/Components/Inputs');
        $file_system->copyDirectory($folder_origin, $destination);

        // Publish components views
        $this->comment('Publications des composants blades');
        $folder_origin = __DIR__.'/../../resources/views/components';
        $destination = resource_path('views/components');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Composants publiés');
        $this->comment('Regenerate the optimized Composer autoloader files.');
        $this->composer->dumpOptimized();
        $this->comment('Composants publiés !');

        return self::SUCCESS;
    }
}
