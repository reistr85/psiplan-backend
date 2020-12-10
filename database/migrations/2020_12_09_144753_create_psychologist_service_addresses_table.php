<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychologistServiceAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychologist_service_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('psychologist_id')->unsigned();
            $table->string('zip_code');
            $table->string('state');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('street');
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('reference')->nullable();
            $table->integer('is_active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('psychologist_id')
                ->references('id')
                ->on('psychologists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychologist_service_addresses');
    }
}
