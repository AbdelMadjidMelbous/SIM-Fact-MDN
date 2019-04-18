<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBcDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bc_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bc_id')->unsigned()->index();
            $table->integer('num_bc');
            $table->integer('lieu_livr_id')->unsigned()->index();
            $table->integer('produit_id')->unsigned()->index();
            $table->integer('quantite_com');
            $table->integer('quantite_livr')->default(0);
            $table->integer('quantite_rest');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bc_id')->references('id')->on('bcs');
            $table->foreign('lieu_livr_id')->references('id')->on('lieu_livrs');
            $table->foreign('produit_id')->references('id')->on('produits');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bc_details');
    }
}
