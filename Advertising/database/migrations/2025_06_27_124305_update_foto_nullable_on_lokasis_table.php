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
        Schema::table('lokasis', function (Blueprint $table) {
            $table->string('foto')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('lokasis', function (Blueprint $table) {
            $table->string('foto')->change();
        });
    }
};
