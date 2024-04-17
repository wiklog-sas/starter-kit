<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Wiklog\StarterKit\StarterKit;

class PublishAllowPlugins extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'allow-plugins';

    public $description = 'Ajoute les plugins autorisés dans le fichier composer.json';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $allow_plugins = [
            "dealerdirect/phpcodesniffer-composer-installer",
        ];

        foreach ($allow_plugins as $allow_plugin) {
            $this->addAllowPlugin($allow_plugin);
        }
        $this->comment('Regenerate the Composer autoloader files.');
        $this->composer->dumpAutoloads();

        return self::SUCCESS;
    }

    public function addAllowPlugin($plugin)
    {
        $composerJsonPath = base_path('composer.json');
        $composerJsonContents = json_decode(File::get($composerJsonPath), true);

        if (!isset($composerJsonContents['config']['allow-plugins'][$plugin])) {
            $composerJsonContents['config']['allow-plugins'][$plugin] = true;

            File::put($composerJsonPath, json_encode($composerJsonContents, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            $this->info("Plugin '$plugin' has been added to allow-plugins section.");
        } else {
            $this->info("Plugin '$plugin' already exists in allow-plugins section.");
        }
    }
}
