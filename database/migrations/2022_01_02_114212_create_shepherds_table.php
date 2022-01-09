<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShepherdsTable extends Migration
{
    public function up()
    {
        Schema::create('shepherds', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->foreignId(
                'user_id'
            )->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::table('shepherds', function (Blueprint $table) {
            $table->dropConstrainedForeignId("user_id");
        });
        Schema::dropIfExists('shepherds');
    }
}
