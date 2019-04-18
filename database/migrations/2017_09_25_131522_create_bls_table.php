<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fact_id')->unsigned()->index();
            $table->integer('num_fact');
            $table->integer('lieu_livr_id')->unsigned()->index();
            $table->string('des_lieu');
            $table->integer('num_region');
            $table->integer('bc_id')->unsigned()->index();
            $table->integer('num_bc');
            $table->integer('num_bl')->unique();
            $table->timestamp('date_bl');
            $table->string('verrouille');
            $table->string('nom_chauffeur');
            $table->string('nom_represantant');
            $table->string('camion');
            $table->string('matricule_camion');
            $table->float('total_ht');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fact_id')->references('id')->on('factures');
            $table->foreign('lieu_livr_id')->references('id')->on('lieu_livrs');
            $table->foreign('bc_id')->references('id')->on('bcs');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bls');
    }
}
