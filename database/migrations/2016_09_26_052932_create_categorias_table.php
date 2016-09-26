<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoria')->unique();
            $table->string('slug')->unique();
            $table->text('descripcion');
            $table->integer('categoria_id')->nullable();
            $table->integer('user_id');
            $table->string('icono',500)->nullable();
            $table->timestamps();
            $table->foreign('categoria_id')
            ->references('id')->on('categorias');
            $table->foreign('user_id')
            ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categorias');
    }
}
