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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile')->unique();
            $table->bigInteger('role_id')->unsigned();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('picture')->default('no-profile.jpg');
            $table->string('title')->nullable();
            $table->string('side')->nullable();
            $table->string('expertise')->nullable();
            $table->text('description')->nullable();
            $table->rememberToken();
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
            $table->integer('deleted_at')->nullable();
            $table->bigInteger('created_by')->unsigned();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
