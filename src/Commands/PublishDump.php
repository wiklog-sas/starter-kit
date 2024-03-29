<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishDump extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'dump';

    public $description = 'Publie les fichiers pour les dumps';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();


        // Publication du fichier newModel.sh
        $this->comment('Publication Dump');
        $file_origin = StarterKit::PATH_PUBLISH_DUMP.'dump/Dump.php';
        $destination = app_path('Classes/Dump/Dump.php');
        $file_system->copy($file_origin, $destination);

        $file_origin = StarterKit::PATH_PUBLISH_DUMP.'command/DumpCommand.php';
        $destination = app_path('Console/Commands/DumpCommand.php');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication réussi !');

        return self::SUCCESS;
    }
}
