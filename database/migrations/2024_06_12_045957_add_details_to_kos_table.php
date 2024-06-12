<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToKosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kos', function (Blueprint $table) {
            $table->integer('capacity')->nullable();
            $table->text('images')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kos', function (Blueprint $table) {
            $table->dropColumn('capacity');
            $table->dropColumn('images');
            $table->dropColumn('phone');
            $table->dropColumn('type');
            $table->dropColumn('description');
        });
    }
}
