<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\AccountHead::class)->constrained()->cascadeOnDelete();
            $table->string('particulars', 255);
            $table->double('debit')->default(0.00);
            $table->double('credit')->default(0.00);
            $table->double('balance')->default(0.00);
            $table->unsignedTinyInteger('type')->default(0)->comment('1=>Debit, 2=>Credit');
            $table->bigInteger('order_id')->default(0);
            $table->bigInteger('product_id')->default(0);
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
        Schema::dropIfExists('account_ledgers');
    }
}
