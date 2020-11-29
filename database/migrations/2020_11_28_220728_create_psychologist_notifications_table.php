<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychologistNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychologist_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('psychologist_id')->unsigned();
            $table->integer('notification_id')->unsigned();
            $table->integer('is_active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('psychologist_id')
                ->references('id')
                ->on('psychologists')
                ->onDelete('cascade');

            $table->foreign('notification_id')
                ->references('id')
                ->on('notifications')
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
        Schema::dropIfExists('psychologist_notifications');
    }
}
