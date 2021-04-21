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
            $table->string('payment_method')->nullable()->after('amount');;
            $table->string('billet_url')->nullable()->after('payment_method');;
            $table->string('billet_barcode')->nullable()->after('billet_url');;
            $table->string('billet_expiration_date')->nullable()->after('billet_barcode');;
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
