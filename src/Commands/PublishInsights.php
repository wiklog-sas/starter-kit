<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishInsights extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'insights';

    public $description = 'Installe php insights avec son fichier de configuration';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Installation insights
        $this->comment('Installation de php insights');
        $this->composer->requirePackages(['nunomaduro/phpinsights'], true);

        // Publication du fichier de configuration
        $file_origin = StarterKit::PATH_PUBLISH_INSIGHTS.'insights.php';
        $destination = config_path('insights.php');
        $file_system->copy($file_origin, $destination);

        $this->comment('Publication de php insights réussis !');

        return self::SUCCESS;
    }
}
