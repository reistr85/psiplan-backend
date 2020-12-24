<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('psychologist_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('psychologist_availability_calendar_id')->unsigned();
            $table->dateTime('day_hour');
            $table->integer('available')->nullable();
            $table->integer('is_active');
            $table->softDeletes();
            $table->timestamps();

            $table
                ->foreign('psychologist_id')
                ->references('id')
                ->on('psychologists')
                ->onDelete('cascade');

            $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table
                ->foreign('psychologist_availability_calendar_id')
                ->references('id')
                ->on('psychologist_availability_calendars')
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
        Schema::dropIfExists('psychologist_queries');
    }
}
