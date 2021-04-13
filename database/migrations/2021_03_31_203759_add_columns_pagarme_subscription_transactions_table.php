<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPagarmeSubscriptionTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagarme_subscription_transactions', function (Blueprint $table) {
            $table->integer('psychologist_id')->unsigned()->nullable()->after('user_id');

            $table->foreign("psychologist_id")
                ->on("psychologists")
                ->references("id")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagarme_subscription_transactions', function (Blueprint $table) {
            $table->dropColumn('psychologist_id');
        });
    }
}
