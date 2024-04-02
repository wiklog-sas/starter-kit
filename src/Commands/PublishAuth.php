<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Wiklog\StarterKit\StarterKit;

class PublishAuth extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'auth';

    public $description = 'Publie les fichiers pour l’authentification';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Installation de laravel Breeze
        $this->info('Installation de laravel Breeze');
        $this->composer->requirePackages(['laravel/breeze'], true);
        $this->info('Installation du stack blade');
        Artisan::call('php artisan breeze:install stack blade');

        // Suppression fichier inutile
        $this->info('Suppression de fichiers inutiles');
        $file_system->deleteDirectory(resource_path('views/profile'));
        $file_system->delete(resource_path('views/welcome.blade.php'));
        $file_system->delete(resource_path('views/dashboard.blade.php'));
        $file_system->delete(base_path('tests/Feature/ProfileTest.php'));
        
        // Fix larastan
        $this->info('Fix larastan sur le fichier VerifyEmailController.php');
        $file_system->copy(StarterKit::PATH_PUBLISH_AUTH . 'VerifyEmailController.php', app_path('Http/Controllers/Auth/VerifyEmailController.php'));

        // Copie web.php
        $this->info('Publication du fichier web.php');
        $file_system->copy(StarterKit::PATH_PUBLISH_AUTH . 'web.php', base_path('routes/web.php'));

        // Copie app.blade.php
        $this->info('Publication du fichier app.blade.php');
        $file_system->copy(StarterKit::PATH_PUBLISH_AUTH . 'app.blade.php', resource_path('views/layouts/app.blade.php'));

        // Copie des blades d'authentification
        $this->info('Publication des fichiers blades pour l’authentification');
        $file_system->copyDirectory(StarterKit::PATH_PUBLISH_AUTH . 'auth', resource_path('views/auth'));

        $this->info('Publication réussi !');

        return self::SUCCESS;
    }
}
