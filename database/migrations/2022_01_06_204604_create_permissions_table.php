<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');          // Visualizar Usuários
            $table->string('slug');          // view-users
            $table->string('groups');        // Usuários
            $table->text('description');     // Permissão para VER os usuários cadastrados no sistema
            $table->timestamps();
        });

        DB::unprepared(file_get_contents(database_path('seeders/jsons/permissions.sql')));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
