<?php

use App\Classes\Commun\ExtendBlueprint;
use Illuminate\Database\Migrations\Migration;
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

        $schema->create('livres', function (ExtendBlueprint $table) {
            $table->id();

            $table->string('title')->unique();
            $table->string('author');
            $table->text('description');
            $table->date('release_date')->nullable();
            $table->float('price', 8, 2)->nullable();

            $table->whoAndWhen();
        });

        Bouncer::allow('admin')->to('livre-create');
        Bouncer::allow('admin')->to('livre-update');
        Bouncer::allow('admin')->to('livre-delete');
        Bouncer::allow('admin')->to('livre-retrieve');
        Bouncer::Refresh();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('livres');
        Schema::enableForeignKeyConstraints();
    }
};
