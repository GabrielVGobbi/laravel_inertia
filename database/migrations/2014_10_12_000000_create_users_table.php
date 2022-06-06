<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                'name' => 'Gabriel Gobbi',
                #'username' => 'gabriel.gobbi',
                'password' => '$2y$10$QygCRy.mrYzVL6vkvatzEepNMFud3bKvvLBAwz/Jbvrms9qFB9p2e',
                'email' => 'gabriel.gobbi15@gmail.com',
                'uuid' => 'e3f083e2-1539-4241-affc-879d21ff4875',
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
