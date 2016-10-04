<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_item',function(Blueprint $table){
            $table->integer('item_id');
            $table->integer('actividad_id');
            $table->integer('user_id');
            $table->timestamps();
            $table->foreign('item_id')
            ->references('id')->on('items');
            $table->foreign('actividad_id')
            ->references('id')->on('actividades');
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
        Schema::drop('actividad_item');
    }
}
