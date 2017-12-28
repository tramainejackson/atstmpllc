<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->integer('account_num')->nullable();
            $table->double('checking_balance', 15, 2)->nullable();
            $table->double('savings_balance', 15, 2)->nullable();
            $table->string('created_by', 30)->nullable();
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
        Schema::dropIfExists('bank_accounts');
    }
}
