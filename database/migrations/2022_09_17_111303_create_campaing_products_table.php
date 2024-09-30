<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaing_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Campaing::class)->constrained()->cascadeOnDelete();
            $table->integer('product_id')->contrained('products')->onDelete('cascade');
            $table->string('product_name', 100);
            $table->double('discount_price', 50)->default(0.00);
            $table->unsignedTinyInteger('discount_type')->default(1)->comment('1=>Flat, 2=>Percentage');
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
        Schema::dropIfExists('campaing_products');
    }
}
