<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->string('phone', 50);
            $table->string('email', 100);
            $table->integer('division_id')->contrained('divisions')->onDelete('cascade')->default(0);
            $table->integer('district_id')->contrained('districts')->onDelete('cascade')->default(0);
            $table->integer('upazilla_id')->contrained('upazillas')->onDelete('cascade')->default(0);
            $table->text('address')->nullable();
            $table->string('payment_method', 25)->default('cash');
            $table->unsignedBigInteger('payment_status')->default(0)->comment('1=>paid, 0=>Unpaid');
            $table->text('payment_details')->nullable();
            $table->float('grand_total')->default(0.00);
            $table->float('coupon_discount')->default(0.00);
            $table->string('invoice_no');
            $table->string('viewed')->default(0);
            $table->string('delivery_viewed')->default(1);
            $table->string('payment_status_viewed')->default(1);
            $table->string('commission_calculated')->default(0);
            $table->text('comment')->nullable();
            $table->string('delivery_status')->default('pending');
            $table->string('tracking_code', 100)->nullable();
            $table->string('confirmed_date', 30)->nullable();
            $table->string('processing_date', 30)->nullable();
            $table->string('picked_date', 30)->nullable();
            $table->string('shipped_date', 30)->nullable();
            $table->string('delivered_date', 30)->nullable();
            $table->string('cancel_date', 30)->nullable();
            $table->string('return_date', 30)->nullable();
            $table->text('return_reason')->nullable();
            $table->unsignedTinyInteger('type')->default(1)->comment('1=>Customer order, 2=>Guest Order, 3=>Inhouse Order');
            $table->bigInteger('created_by')->contrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
