<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
			$table->integer('company_id')->nullable();
            $table->string('username', 30)->unique();
            $table->string('firstname', 30)->nullable();
            $table->string('lastname', 30)->nullable();
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->string('picture', 100);
            $table->char('editable', 1);
            $table->timestamp('last_login');
            $table->rememberToken();
            $table->timestamps();
			$table->softDeletes();
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
