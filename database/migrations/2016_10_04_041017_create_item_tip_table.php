<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_tip',function(Blueprint $table){
            $table->integer('item_id');
            $table->integer('tip_id');
            $table->integer('user_id');
            $table->timestamps();
            $table->foreign('item_id')
            ->references('id')->on('items');
            $table->foreign('tip_id')
            ->references('id')->on('tips');
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
        Schema::drop('item_tip');
    }
}
