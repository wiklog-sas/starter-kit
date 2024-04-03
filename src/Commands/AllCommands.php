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
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'env');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'postcss');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'npmVite');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'traits');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'auth');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'bouncer');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'commun');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'components');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'controller');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'template-crud');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'dump');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'editorconfig');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'blueprint');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'git');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'helpers');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'ide_helper');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'insights');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'kernel');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'larastan');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'librairies');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'pdfMulticell');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'phpunit');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'pint');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'readme');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'resourcesJs');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'resourcesScss');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'resourcesViews');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'stubs');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'webfonts');
        Artisan::call(StarterKit::PREFIX_SIGNATURE.'workflow');

        return self::SUCCESS;
    }
}
