<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_item',function(Blueprint $table){
            $table->integer('item_id');
            $table->integer('categoria_id');
            $table->integer('user_id');
            $table->timestamps();
            $table->foreign('item_id')
            ->references('id')->on('items');
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
        Schema::drop('categoria_item');
    }
}
