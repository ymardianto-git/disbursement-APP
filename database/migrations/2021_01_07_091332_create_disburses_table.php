<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disburses', function (Blueprint $table) {
            $table->id();
            $table->string('account_number');
            $table->string('transaction_id');
            $table->string('bank_code');
            $table->float('amount', 10, 2);
            $table->float('fee', 10,2);
            $table->char('status', '10');
            $table->string('beneficiary_name');
            $table->string('remark');
            $table->string('receipt')->nullable();
            $table->timestamp('time_served')->nullable();
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
        Schema::dropIfExists('disburses');
    }
}
