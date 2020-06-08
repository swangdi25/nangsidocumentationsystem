<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGmemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gmembers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constraint()->reference('id')->on('tbl_groups')->onDelete('cascade');
            $table->foreignId('member_id')->constraint()->reference('id')->on('tbl_users')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_gmembers');
    }
}
