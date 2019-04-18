<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('marche_id')->unsigned()->index();
            $table->integer('num_bc')->unique();
            $table->timestamp('date_bc');
            $table->string('bimestre');
            $table->string('solde');
            $table->integer('total_qt');
            $table->float('total_ht');
            $table->boolean('valide')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('marche_id')->references('id')->on('marches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bcs');
    }
}
