<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_letters', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no',20);
            $table->string('type',10);
            $table->string('subject',100);
            $table->string('address');
            $table->string('place');
            $table->string('filename',50);
            $table->string('file_attachment_link');
            $table->boolean('important')->default(0);
            $table->string('status',10);
            $table->date('action_date')->nullable();
            $table->foreignId('created_by')->nullable()->reference('id')->on('tbl_users');
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
        Schema::dropIfExists('tbl_letters');
    }
}
