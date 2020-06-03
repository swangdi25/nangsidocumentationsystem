<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_incomings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_id')->constraint()->reference('id')->on('tbl_letters')->onDelete('cascade');
            $table->foreignId('receiver_id')->constraint()->reference('id')->on('tbl_users')->onDelete('cascade');
            $table->string('mode_of_receive');
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
        Schema::dropIfExists('tbl_incomings');
    }
}
