<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_markeds', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->foreignId('letter_id')->constraint()->reference('id')->on('tbl_letters')->onDelete('cascade');
            $table->foreignId('marked_to')->nullable()->reference('id')->on('tbl_users');
            $table->foreignId('created_by')->reference('id')->on('tbl_users');
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
        Schema::dropIfExists('tbl_markeds');
    }
}
