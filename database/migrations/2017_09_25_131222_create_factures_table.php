<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_fact')->unique();
            $table->timestamp('date_fact');
            $table->integer('num_bl');
            $table->integer('lieu_livr_id')->unsigned()->index();
            $table->string('des_lieu');
            $table->integer('num_region');
            $table->float('montant_tva');
            $table->float('total_ht');
            $table->float('total_ttc');
            $table->string('total_lettres');
            $table->string('verrouille');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lieu_livr_id')->references('id')->on('lieu_livrs');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
