<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_notices', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no');
            $table->string('subject');
            $table->string('file_link');
            $table->string('from');
            $table->text('summary');
            $table->foreignId('created_by')->constraint()->reference('id')->on('tbl_users');
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
        Schema::dropIfExists('tbl_notices');
    }
}
