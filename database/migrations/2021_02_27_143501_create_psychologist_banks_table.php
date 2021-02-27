<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychologistBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychologist_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('psychologist_id')->unsigned();
            $table->string('bank_id')->nullable();
            $table->string('bank_code');
            $table->string('bank_type_account')->nullable();
            $table->string('agency');
            $table->string('agency_dv')->nullable();
            $table->string('number_account');
            $table->string('number_account_dv')->nullable();
            $table->string('name_holder_account')->nullable();
            $table->string('cpf_holder_account')->nullable();
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('psychologist_banks');
    }
}
