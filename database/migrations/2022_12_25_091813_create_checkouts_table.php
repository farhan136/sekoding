<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('camp_id')->nullable();
            $table->string('card_number', 20);
            $table->date('expired')->nullable();
            $table->string('cvc', 3);
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
};
