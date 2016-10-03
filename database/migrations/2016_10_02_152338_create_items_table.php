<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->text('descripcion')->nullable();
            $table->string('web')->nullable();
            $table->string('fuente')->nullable();
            $table->string('google_id')->nullable();
            $table->string('wiki_url')->nullable();
            $table->string('hashtag')->nullable();
            $table->integer('user_id');
            $table->integer('visitas')->default(0);
            $table->foreign('user_id')
            ->references('id')->on('users');
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
        Schema::drop('items');
    }
}
