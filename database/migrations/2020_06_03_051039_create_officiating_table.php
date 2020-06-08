<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficiatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_officiatings', function (Blueprint $table) {
            $table->id();
            $table->date('fromdate');
            $table->date('todate')->nullable();
            $table->string('officiating_as');
            $table->foreignId('officiating_of')->nullable()->reference('id')->on('tbl_users')->onDelete('cascade');
            $table->foreignId('officiating_by')->constraint()->reference('id')->on('tbl_users')->onDelete('cascade');
            $table->foreignId('created_by')->constraint()->reference('id')->on('tbl_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_officiatings');
    }
}
