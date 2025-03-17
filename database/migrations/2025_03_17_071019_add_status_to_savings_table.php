<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('savings', function (Blueprint $table) {
            $table->string('status')->default('pending'); // You can change the default value as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('savings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
