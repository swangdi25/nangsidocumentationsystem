<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cid',11);
            $table->string('eid',11);
            $table->string('designation');
            $table->string('phone',13)->nullable();
            $table->string('officephone',10)->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('status')->default(0);        
            $table->foreignId('agency_id')->constraint()->references('id')->on('tbl_agencies');
            $table->foreignId('division_id')->nullable()->reference('id')->on('tbl_divisions');
            $table->foreignId('role_id')->constraint()->reference('id')->on('tbl_roles');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('tbl_users');
    }
}
