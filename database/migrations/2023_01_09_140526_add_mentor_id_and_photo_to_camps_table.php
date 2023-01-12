<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('camps', function (Blueprint $table) {
            $table->string('banner')->nullable();
            $table->integer('mentor_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('camps', function (Blueprint $table) {
            $table->dropColumn('banner');
            $table->dropColumn('mentor_id');
        });
    }
};
