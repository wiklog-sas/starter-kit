<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishPdfMulticell extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_CMD.'pdfMulticell';

    public $description = 'Publie les fichiers pour la génération de PDF Multicell';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();
        $this->composer->requirePackages(['setasign/fpdf', 'setasign/fpdi']);

        // Publish pdf files
        $this->comment('Publications des fichiers PdfMulticell');
        $folder_origin = StarterKit::RESOURCES_PATH.'classes/pdf';
        $destination = app_path('Classes/PDF');
        $file_system->copyDirectory($folder_origin, $destination);

        $this->comment('Fichiers publiés');
        $this->comment('Regenerate the optimized Composer autoloader files.');
        $this->composer->dumpOptimized();
        $this->comment('Publication réussi !');

        return self::SUCCESS;
    }
}
