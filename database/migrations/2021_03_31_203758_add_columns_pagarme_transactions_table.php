<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsPagarmeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagarme_transactions', function (Blueprint $table) {
            $table->string('payment_method');
            $table->string('billet_url')->nullable();
            $table->string('billet_barcode')->nullable();
            $table->string('billet_expiration_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagarme_transactions', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('billet_url');
            $table->dropColumn('billet_barcode');
            $table->dropColumn('billet_expiration_date');
        });
    }
}
