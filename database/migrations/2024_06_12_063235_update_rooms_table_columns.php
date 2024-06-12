<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoomsTableColumns extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('room_number')->after('id');
            $table->text('facilities')->nullable()->after('description');
            $table->string('images')->nullable()->after('facilities');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['room_number', 'facilities', 'images']);
            $table->string('name')->after('id');
        });
    }
}

