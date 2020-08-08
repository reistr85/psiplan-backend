<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychologistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychologists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->date('birth');
            $table->string('cpf');
            $table->string('phone', 11);
            $table->string('country');
            $table->string('crp');
            $table->string('psi');
            $table->string('bank');
            $table->string('agency');
            $table->string('type_account');
            $table->string('number_account');
            $table->string('cpf_holder_account');
            $table->string('cnpj_holder_account');
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
        Schema::dropIfExists('psychologists');
    }
}
