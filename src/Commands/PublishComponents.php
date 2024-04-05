<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishComponents extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'components';

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
        $folder_origin = StarterKit::PATH_PUBLISH_COMPONENTS.'Inputs';
        $destination = app_path('View/Components/Inputs');
        $file_system->copyDirectory($folder_origin, $destination);

        // Publish components views
        $this->comment('Publications des composants blades');
        $folder_origin = StarterKit::PATH_PUBLISH_COMPONENTS.'components';
        $destination = resource_path('views/components');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Composants publiés !');

        return self::SUCCESS;
    }
}
