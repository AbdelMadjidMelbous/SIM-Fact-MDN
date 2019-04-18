<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fact_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fact_id')->unsigned()->index();
            $table->integer('num_fact');
            $table->integer('produit_id')->unsigned()->index();
            $table->float('prix_unit_ht');
            $table->integer('tva_id')->unsigned()->index();
            $table->float('montant_tva');
            $table->float('montant_ht');
            $table->float('montant_ttc');
            $table->string('verrouille');
            $table->integer('quantite_livr');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fact_id')->references('id')->on('factures');
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
        Schema::dropIfExists('fact_details');
    }
}
