<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Wiklog\StarterKit\StarterKit;

class AllCommands extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'all';

    public $description = 'Lance toutes les publications';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $this->info('Publication des fichiers .env');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'env');

        $this->info('Génération de la clé de l’application');
        shell_exec('php artisan key:generate');
        Artisan::call('key:generate');
        $this->comment('Pensez à l’ajouter aussi pour le .env.testing');
        Artisan::call('config:cache');
        $this->composer->dumpOptimized();

        shell_exec('php artisan migrate:fresh');

        $this->info('Publication du fichier de configuration app.php');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'config');

        $this->info('Publication des traits');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'traits');

        $this->info('Installation de laravel/breeze et configuration de l’authentification');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'auth');

        $this->info('Installation de silber/bouncer et publication de la migration');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'bouncer');

        $this->info('Publication du fichier postcss');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'postcss');

        $this->info('Publication des resources javascripts');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'resourcesJs');

        $this->info('Publication des resources scss');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'resourcesScss');

        $this->info('Publication des resources views');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'resourcesViews');

        $this->info('Installation de npm et configuration de Vite');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'npmVite');

        $this->info('Publication des resources communes');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'commun');

        $this->info('Publication des components');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'components');

        $this->info('Publication du controller');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'controller');

        $this->info('Publication du fichier ExtendBlueprint.php');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'blueprint');

        $this->info('Publication d’un crud template basique');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'template-crud');

        $this->info('Publication des fichiers dump');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'dump');

        $this->info('Publication du fichier editorconfig');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'editorconfig');

        $this->info('Configuration de git');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'git');

        $this->info('Publication du fichier helpers.php et ajout en fichier autoload dans le composer.json');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'helpers');

        $this->info('Installation et configuration de barryvdh/laravel-ide-helper');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'ide_helper');

        $this->info('Installation et configuration de nunomaduro/phpinsights');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'insights');

        $this->info('Configuration du Kernel');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'kernel');

        $this->info('Installation et configuration de larastan/larastan');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'larastan');

        $this->info('Publication de la migration de la table librairies');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'librairies');

        $this->info('Installation de setasign/fpdf et setasign/fpdi et publication des fichiers PDFMulticell');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'pdfMulticell');

        $this->info('Installation et configuration de phpunit/phpunit');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'phpunit');

        $this->info('Installation et configuration de laravel/pint');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'pint');

        $this->info('Publication du fichier README.md');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'readme');

        $this->info('Publication des stubs');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'stubs');

        $this->info('Publication des webfonts');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'webfonts');

        $this->info('Publication du fichier de configuration pour le workflow de GitHub Action');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'workflow');

        $this->info('Lancement des seeders');
        shell_exec('php artisan db:seed');

        $this->warn('Publication réussis !');

        return self::SUCCESS;
    }
}
