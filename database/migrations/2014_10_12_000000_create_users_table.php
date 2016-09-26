<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('github_id')->nullable();
            $table->string('bitbucket_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('instagram_id')->nullable();
            $table->string('yahoo_id')->nullable();
            $table->string('live_id')->nullable();
            $table->string('twitch_id')->nullable();
            $table->string('spotify_id')->nullable();
            $table->char('genero',10)->nullable();
            $table->integer('pais_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
