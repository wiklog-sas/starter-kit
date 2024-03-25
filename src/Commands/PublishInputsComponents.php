<?php

namespace Wiklog\StarterKit\Commands;

use DirectoryIterator;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\File;

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
        $destination = app_path('View/Components');
        $file_system->copyDirectory($folder_origin, $destination);
        
        //Publish Inputs views
        $folder_origin = __DIR__.'/../../resources/components/inputs/views/';
        $destination = resource_path('views/components/inputs');
        $this->publishFilesInFolder($folder_origin, $destination);

        $this->comment('Composants inputs publiés');

        $this->composer->dumpOptimized();
        $this->comment('Package installé');

        return self::SUCCESS;
    }

    public function publishFilesInFolder($folder_origin, $destination_files)
    {
        foreach (new DirectoryIterator($folder_origin) as $file) {
            if ($file->isFile()) {
                $file_contents = file_get_contents($folder_origin.$file->getFilename());
                $this->createFile($destination_files.DIRECTORY_SEPARATOR, $file->getFilename(), $file_contents);

                $this->comment($file->getFilename().' publié');
            }
        }
    }

    public static function createFile($path, $filename, $contents)
    {
        if (! file_exists($path)) {
            mkdir($path, 0755, true);
        }
        file_put_contents($path.$filename, $contents);
    }
}
