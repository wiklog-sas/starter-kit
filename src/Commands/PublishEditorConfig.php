<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishEditorConfig extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'editorconfig';

    public $description = 'Publie le fichier .editorconfig';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication du fichier de configuration
        $this->comment('Publication du fichier .editorconfig');
        $file_origin = StarterKit::PATH_PUBLISH_EDITOR_CONFIG . '.editorconfig';
        $destination = base_path('.editorconfig');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication du fichier .editorconfig réussis !');

        return self::SUCCESS;
    }
}
