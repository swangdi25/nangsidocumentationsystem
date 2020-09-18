<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_references', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->text('description');
            $table->foreignId('agency_id')->nullable()->reference('id')->on('tbl_agencies');
            $table->foreignId('division_id')->nullable()->reference('id')->on('tbl_divisions');
            $table->string('status',10)->default('active');
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
        Schema::dropIfExists('tbl_references');
    }
}
