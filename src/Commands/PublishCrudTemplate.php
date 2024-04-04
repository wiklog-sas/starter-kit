<?php

namespace Wiklog\StarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Wiklog\StarterKit\StarterKit;

class PublishCrudTemplate extends Command
{
    /* php artisan [signature] */
    public $signature = StarterKit::PREFIX_SIGNATURE.'template-crud';

    public $description = 'Publie un crud template simple';

    public Composer $composer;

    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle(): int
    {
        $file_system = new Filesystem();

        // Publication de la migration
        $this->comment('Publication de la migration');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. '2024_02_12_103228_create_livres_table.php';
        $destination = database_path('migrations/'. date('Y_m_d_His') . '_create_livres_table.php');
        $file_system->copy($file_origin, $destination);

        // Publication du model
        $this->comment('Publication du model');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'Livre.php';
        $destination = app_path('Models/Livre.php');
        $file_system->copy($file_origin, $destination);

        // Publication du controller
        $this->comment('Publication du controller');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'LivreController.php';
        $this->createDirIfNotExists(app_path('Http/Controllers/Livre'));
        $destination = app_path('Http/Controllers/Livre/LivreController.php');
        $file_system->copy($file_origin, $destination);

        // Publication du modelRequest
        $this->comment('Publication du modelRequest');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'LivreModelRequest.php';
        $this->createDirIfNotExists(app_path('Http/Requests/Livre'));
        $destination = app_path('Http/Requests/Livre/LivreModelRequest.php');
        $file_system->copy($file_origin, $destination);

        // Publication du service
        $this->comment('Publication du service');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'LivreService.php';
        $this->createDirIfNotExists(app_path('Http/Services/Livre'));
        $destination = app_path('Http/Services/Livre/LivreService.php');
        $file_system->copy($file_origin, $destination);

        // Publication du repository
        $this->comment('Publication du repository');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'LivreRepository.php';
        $this->createDirIfNotExists(app_path('Http/Repositories/Livre'));
        $destination = app_path('Http/Repositories/Livre/LivreRepository.php');
        $file_system->copy($file_origin, $destination);

        // Publication de la factory
        $this->comment('Publication de la factory');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'LivreFactory.php';
        $destination = database_path('factories/LivreFactory.php');
        $file_system->copy($file_origin, $destination);

        // Publication de la UserFactory
        $this->comment('Publication de la user factory');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'UserFactory.php';
        $destination = database_path('factories/UserFactory.php');
        $file_system->copy($file_origin, $destination);

        // Publication du seeder
        $this->comment('Publication du seeder');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'LivreSeeder.php';
        $destination = database_path('seeders/LivreSeeder.php');
        $file_system->copy($file_origin, $destination);

        // Publication du DatabaseSeeder
        $this->comment('Publication du DatabaseSeeder');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'DatabaseSeeder.php';
        $destination = database_path('seeders/DatabaseSeeder.php');
        $file_system->copy($file_origin, $destination);

        // Publication du test
        $this->comment('Publication du test');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'LivreTest.php';
        $this->createDirIfNotExists(base_path('tests/Feature/Models'));
        $destination = base_path('tests/Feature/Models/LivreTest.php');
        $file_system->copy($file_origin, $destination);

        // Publication du TestCase
        $this->comment('Publication du testcase');
        $file_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'TestCase.php';
        $this->createDirIfNotExists(base_path('tests/'));
        $destination = base_path('tests/TestCase.php');
        $file_system->copy($file_origin, $destination);

        // Publication des vues
        $this->comment('Publication des vues');
        $folder_origin = StarterKit::PATH_PUBLISH_CRUD_TEMPLATE. 'views';
        
        $destination = resource_path('views/livre');
        $this->createDirIfNotExists(resource_path('views/livre'));
        $file_system->copyDirectory($folder_origin, $destination);

        shell_exec('php artisan migrate');

        return self::SUCCESS;
    }

    /**
     * Créer un dossier s'il n'existe pas
     *
     * @param  string  $path
     * @return void
     */
    public function createDirIfNotExists(string $path): void
    {
        $file_system = new Filesystem();
        if (! $file_system->exists($path)) {
            $file_system->makeDirectory($path, recursive: true);
        }
    }
}
