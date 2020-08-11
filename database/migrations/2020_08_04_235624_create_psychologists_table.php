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
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->date('birth')->nullable();
            $table->string('cpf')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('country')->nullable();

            $table->decimal('query_value', 10, 2)->nullable();
            $table->decimal('query_value_social', 10, 2)->nullable();
            $table->integer('query_duration')->nullable();
            $table->text('description')->nullable();

            $table->string('crp')->nullable();
            $table->string('pis')->nullable();
            $table->integer('bank_id')->unsigned();
            $table->string('agency')->nullable();
            $table->string('type_account')->nullable();
            $table->string('number_account')->nullable();
            $table->string('cpf_holder_account')->nullable();
            $table->string('cnpj_holder_account')->nullable();

            $table->integer('active');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
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
        Schema::dropIfExists('psychologists');
    }
}
