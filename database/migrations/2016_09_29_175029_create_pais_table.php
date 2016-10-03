<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pais');
            $table->string('short_name');
            $table->string('continente')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('bandera_url')->nullable();
            $table->string('escudo_url')->nullable();
            $table->string('zipcode')->nullable();
            $table->double('lat')->nullable();//latitud de punto central para mapa
            $table->double('lng')->nullable();//longitud de punto central para mapa
            $table->double('zoom')->default(7);//Zoom que cubre todo el pais
            $table->integer('n_items')->default(0);//Numero de elementos de interes del pais
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paises');
    }
}
