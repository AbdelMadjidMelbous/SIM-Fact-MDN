<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bl_id')->unsigned()->index();
            $table->integer('num_bl');
            $table->integer('produit_id')->unsigned()->index();
            $table->float('prix_unit_ht');
            $table->integer('tva_id')->unsigned()->index();
            $table->float('montant_tva');
            $table->float('montant_ht');
            $table->float('montant_ttc');
            $table->string('verrouille');
            $table->integer('quantite_com');
            $table->integer('quantite_livr');            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bl_id')->references('id')->on('bls');
            $table->foreign('produit_id')->references('id')->on('produits');
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
        Schema::dropIfExists('bl_details');
    }
}
