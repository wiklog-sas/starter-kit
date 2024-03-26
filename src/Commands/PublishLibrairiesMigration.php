<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\Starter\Starter;

class PublishLibrairiesMigration extends Command
{
    /* php artisan [signature] */
    public $signature = Starter::PREFIX_CMD . 'librairies';

    public $description = 'Publie la migration pour la table librairies';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publish migration file
        $this->comment('Publications du fichier de migration');

        $file_origin = Starter::MIGRATION_PATH . '2024_01_23_112424_create_librairies_table.php';
        $destination = database_path('migrations');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication de la migration réussi !');

        return self::SUCCESS;
    }
}
