<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_account_id')->nullable();
            $table->integer('user_account_id')->nullable();
            $table->string('type', 10)->nullable();
            $table->string('account_type', 10)->nullable();
            $table->string('deposit_type', 10)->nullable();
            $table->string('withdrawl_type', 10)->nullable();
            $table->string('transfer_type', 10)->nullable();
            $table->string('transfer_to', 10)->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->date('transaction_date')->nullable();
            $table->char('receipt', 1)->default('N');
            $table->string('receipt_photo', 100)->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
