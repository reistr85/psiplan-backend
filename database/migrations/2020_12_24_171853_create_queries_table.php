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
            $table->integer('coupon_id')->nullable()->unsigned();
            $table->integer('video_platform_id')->nullable()->unsigned();
            $table->dateTime('day_hour');
            $table->decimal('price', 10, 2);
            $table->string('transaction_id')->nullable();
            $table->string('status_evaluation')->default('not_evaluated')->nullable();
            $table->string('status_query')->default('scheduled')->nullable();
            $table->string('status_payment')->default('unpaid')->nullable();
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
                ->foreign('coupon_id')
                ->references('id')
                ->on('coupons')
                ->onDelete('cascade');

            $table
                ->foreign('video_platform_id')
                ->references('id')
                ->on('video_platforms')
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
