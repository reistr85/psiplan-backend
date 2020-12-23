<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychologistDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychologist_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('psychologist_id')->unsigned();
            $table->string('crp')->nullable();
            $table->integer('status_crp')->nullable();
            $table->string('address')->nullable();
            $table->integer('status_address')->nullable();
            $table->string('certificate_crp')->nullable();
            $table->integer('status_certificate')->nullable();
            $table->string('epsi')->nullable();
            $table->integer('status_epsi')->nullable();
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
        Schema::dropIfExists('psychologist_documents');
    }
}
