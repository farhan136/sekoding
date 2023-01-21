<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn('cvc');
            $table->dropColumn('is_paid');
            $table->dropColumn('card_number');
            $table->dropColumn('expired');
            $table->string('payment_status')->nullable()->default("Waiting")->after('camp_id');
            $table->string('midtrans_url')->nullable()->after('payment_status');
        });
    }

    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('card_number', 20)->nullable();
            $table->date('expired')->nullable();
            $table->string('cvc', 3)->nullable();
            $table->boolean('is_paid')->default(false);
            $table->dropColumn('payment_status');
            $table->dropColumn('midtrans_url');
        });
    }
};
