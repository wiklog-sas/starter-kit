<?php

use App\Classes\Commun\ExtendBlueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = DB::getSchemaBuilder();
        $schema->blueprintResolver(function ($table, $callback) {
            return new ExtendBlueprint($table, $callback);
        });

        $schema->create('librairies', function (ExtendBlueprint $table) {
            $table->id();
            $table->string('name', 30)->comment('Nom de la librairie');
            $table->string('type', 3)->comment('Type de la librairie');
            $table->string('lang', 2)->nullable()->comment('Langue de la librairie');
            $table->string('version', 10)->nullable()->comment('Version de la librairie');
            $table->string('link', 250)->nullable()->comment('Lien vers le CDN');
            $table->string('integrity', 100)->nullable()->comment('Clef intégrité de la librairie');
            $table->string('crossorigin', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['name', 'type', 'lang', 'version'], 'uk_librairies');
        });

        $data = [
            ['id' => 1, 'name' => 'jqueryv3', 'type' => 'js', 'lang' => null, 'version' => '3.60', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', 'integrity' => 'sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 7, 'name' => 'ckeditor', 'type' => 'js', 'lang' => null, 'version' => '4.16.1', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.1/ckeditor.min.js', 'integrity' => 'sha512-nUL0aO6dEZx9ixCejPoJWXjFgJt4f70KxWnzbqkFJBmbJtiVz6/njEZHEvh3n0t+rHmq1oGwkCy2E2waJg9fsA==', 'crossorigin' => null, 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 8, 'name' => 'bootstrap-select', 'type' => 'css', 'lang' => null, 'version' => '1.14.0', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css', 'integrity' => 'sha512-g2SduJKxa4Lbn3GW+Q7rNz+pKP9AWMR++Ta8fgwsZRCUsawjPvF/BxSMkGS61VsR9yinGoEgrHPGPn2mrj8+4w==', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 9, 'name' => 'bootstrap-select', 'type' => 'js', 'lang' => null, 'version' => '1.14.0', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js', 'integrity' => 'sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 10, 'name' => 'bootstrap-select', 'type' => 'js', 'lang' => 'fr', 'version' => '1.14.0', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/i18n/defaults-fr_FR.min.js', 'integrity' => 'sha512-iSMVUqsTfdrtxC2QxpVIo+/lbhGmD5cZhg997TNDu46LDlRJ6Y3NMqhhXWgNg01yYkaPu9kBwObdm+oLRlJwrg==', 'crossorigin' => null, 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 11, 'name' => 'dropzone', 'type' => 'css', 'lang' => null, 'version' => '5.9.2', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css', 'integrity' => 'sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 12, 'name' => 'dropzone', 'type' => 'js', 'lang' => null, 'version' => '5.9.2', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js', 'integrity' => 'sha512-llCHNP2CQS+o3EUK2QFehPlOngm8Oa7vkvdUpEFN71dVOf3yAj9yMoPdS5aYRTy8AEdVtqUBIsVThzUSggT0LQ==', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 18, 'name' => 'jqueryui', 'type' => 'css', 'lang' => null, 'version' => '1.12.1', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css', 'integrity' => null, 'crossorigin' => null, 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 19, 'name' => 'jqueryui', 'type' => 'js', 'lang' => null, 'version' => '1.12.1', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', 'integrity' => null, 'crossorigin' => null, 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 20, 'name' => 'bootstrap-datepicker', 'type' => 'js', 'lang' => null, 'version' => '1.9.0', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js', 'integrity' => null, 'crossorigin' => null, 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 21, 'name' => 'bootstrap-datepicker', 'type' => 'js', 'lang' => 'fr', 'version' => '1.9.0', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js', 'integrity' => null, 'crossorigin' => null, 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 22, 'name' => 'bootstrap-datepicker', 'type' => 'css', 'lang' => null, 'version' => '1.9.0', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css', 'integrity' => null, 'crossorigin' => null, 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 27, 'name' => 'owl-carousel2', 'type' => 'js', 'lang' => null, 'version' => '2.3.4', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="', 'integrity' => 'sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 28, 'name' => 'owl-carousel2', 'type' => 'css', 'lang' => null, 'version' => '2.3.4', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', 'integrity' => 'sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 29, 'name' => 'owl-carousel2', 'type' => 'css', 'lang' => 'fr', 'version' => '2.3.4', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', 'integrity' => 'sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 30, 'name' => 'select2', 'type' => 'css', 'lang' => null, 'version' => '4.0.13', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', 'integrity' => 'sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 31, 'name' => 'select2', 'type' => 'js', 'lang' => null, 'version' => '4.0.13', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js', 'integrity' => 'sha256-vjFnliBY8DzX9jsgU/z1/mOuQxk7erhiP0Iw35fVhTU=', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 32, 'name' => 'select2', 'type' => 'js', 'lang' => 'fr', 'version' => '4.0.13', 'link' => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/fr.min.js', 'integrity' => 'sha256-oGcfNWA7zLzWM0kqNel+MVLxhaFRj+Q5mzT04BZgM6A=', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
            ['id' => 35, 'name' => 'sweetalert2', 'type' => 'js', 'lang' => null, 'version' => '11.0.11', 'link' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11.0.11/dist/sweetalert2.all.min.js', 'integrity' => 'sha256-6JV5RSLPMV5hC1hhmU9TLV9Ca5ie8vlTDv9wJXnyYwc=', 'crossorigin' => 'anonymous', 'created_at' => date('Y-m-d H:s;i'), 'updated_at' => null, 'deleted_at' => null],
        ];

        DB::table('librairies')->insert($data);
        DB::insert('insert into librairies values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            null,
            'leaflet',
            'css',
            null,
            '1.7.1',
            'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css',
            'sha512-1xoFisiGdy9nvho8EgXuXvnpR5GAMSjFwp40gSRE3NwdUdIMIKuPa7bqoUhLD0O/5tPNhteAsE5XyyMi5reQVA==',
            'anonymous',
            Carbon::now(),
            null,
            null,
        ]);
        DB::insert('insert into librairies values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            null,
            'leaflet',
            'js',
            null,
            '1.7.1',
            'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js',
            'sha512-SeiQaaDh73yrb56sTW/RgVdi/mMqNeM2oBwubFHagc5BkixSpP1fvqF47mKzPGWYSSy4RwbBunrJBQ4Co8fRWA==',
            'anonymous',
            Carbon::now(),
            null,
            null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('librairies');
        Schema::enableForeignKeyConstraints();
    }
};
