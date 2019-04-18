<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->index(); 
            $table->integer('tva_id')->unsigned()->index();
            $table->string('code_produit')->unique();
            $table->string('des_produit');
            $table->float('prix_unit_ht');
            $table->float('prix_unit_ttc');
            $table->string('u_mesure');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')->references('id')->on('type_produits');
            $table->foreign('tva_id')->references('id')->on('tvas');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
