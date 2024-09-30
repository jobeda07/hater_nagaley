<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeValueProductPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_value_product_price', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ProductPrice::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AttributeValue::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_product_combinations');
    }
}
