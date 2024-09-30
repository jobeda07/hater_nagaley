<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code', 50);
            $table->unsignedTinyInteger('discount_type')->default('1')->comment('1=>Fixed Amount, 0=>Percent');
            $table->float('discount',20,2)->default(0.00);
            $table->float('limit_per_user', 20,2)->default(0.00);
            $table->float('total_use_limit', 20,2)->default(0.00);
            $table->date('expire_date', 20)->nullable();
            $table->unsignedTinyInteger('type')->default('1')->comment('1=>All Customers, 0=>Specific Customer');
            $table->string('user_id')->nullable();
            $table->longtext('description')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
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
        Schema::dropIfExists('coupons');
    }
}
