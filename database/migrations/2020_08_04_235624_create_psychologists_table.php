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
            $table->integer('city_id')->unsigned();
            $table->integer('plan_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('email');
            $table->text('description')->nullable();
            $table->text('approach')->nullable();
            $table->date('birth')->nullable();
            $table->string('cpf')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('country')->nullable();
            $table->integer('consultation_duration')->nullable();
            $table->decimal('consultation_value', 10, 2)->nullable();
            $table->decimal('social_consultation_value', 10, 2)->nullable();
            $table->integer('first_free_consultation')->nullable();
            $table->integer('consultation_package')->nullable();
            $table->integer('voluntary_service')->nullable();
            $table->integer('profile_consultation_value')->nullable();
            $table->integer('libras')->nullable();
            $table->integer('accessibility')->nullable();
            $table->string('avatar')->nullable();
            $table->string('gallery_one')->nullable();
            $table->string('gallery_tow')->nullable();
            $table->string('gallery_three')->nullable();
            $table->string('gallery_four')->nullable();
            $table->string('gallery_five')->nullable();
            $table->string('url_youtube')->nullable();
            $table->integer('platform_zoom')->nullable();
            $table->integer('platform_skype')->nullable();
            $table->integer('platform_hangouts')->nullable();
            $table->integer('platform_whatsapp')->nullable();
            $table->string('crp')->nullable();
            $table->string('pis')->nullable();
            $table->string('bank')->nullable();
            $table->string('agency')->nullable();
            $table->string('type_account')->nullable();
            $table->string('number_account')->nullable();
            $table->string('cpf_holder_account')->nullable();
            $table->string('cnpj_holder_account')->nullable();
            $table->integer('is_active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->foreign('plan_id')
                ->nullable()
                ->references('id')
                ->on('plans')
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
