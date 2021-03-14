<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagarmePostBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagarme_post_backs', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('pagarme_post_back', 'pagarme_post_back_id_index');
            $table->string('postback_id')->nullable();
            $table->string('postback_event')->nullable();
            $table->string('postback_object')->nullable();
            $table->string('postback_old_status')->nullable();
            $table->string('postback_current_status')->nullable();
            $table->text('postback_payload')->nullable();
            $table->integer('is_active')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('pagarme_post_backs');
    }
}
