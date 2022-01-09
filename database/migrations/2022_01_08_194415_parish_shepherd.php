<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ParishShepherd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parish_shepherd', function (Blueprint $table) {
            $table->id();
            $table->date('arrived_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->foreignId('shepherd_id')->constrained('shepherds')->onDelete('cascade');
            $table->foreignId('parish_id')->constrained('parishes')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parish_shepherd', function (Blueprint $table) {
            $table->dropConstrainedForeignId("shepherd_id");
            $table->dropConstrainedForeignId("parish_id");
        });
        Schema::dropIfExists('parish_shepherd');
    }
}
