<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {           

            $table->bigIncrements('id');

            $table->integer('idMatch'); 
            $table->integer('idTorneo');
            $table->integer('idUser');            
            $table->integer('goalMore'); 
            $table->integer('goalLess');
            $table->integer('points'); 
            $table->string('statusResult')->nullable();  
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
