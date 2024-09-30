<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            $table->foreignIdFor(\App\Models\Category::class)->constrained()->cascadeOnDelete();
            $table->integer('sub_category_id')->nullable();
            $table->integer('sub_sub_category_id')->nullable();
            $table->string('tags')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('campaing_id')->nullable();
            $table->string('name_en', 255);
            $table->string('name_bn', 255)->nullable();
            $table->string('slug', 150);
            $table->string('product_code', 50)->nullable();
            $table->double('purchase_price')->default(0.00);
            $table->unsignedTinyInteger('is_wholesell')->default(0)->comment('1=>Wholesell, 0=>Not Wholesell');
            $table->double('wholesell_price')->default(0.00);
            $table->integer('wholesell_minimum_qty')->default(0);
            $table->double('regular_price')->default(0.00);
            $table->double('discount_price')->default(0.00);
            $table->unsignedTinyInteger('discount_type')->default(1)->comment('1=>Flat, 2=>Percentage');
            $table->integer('minimum_buy_qty')->default(1);
            $table->integer('stock_qty')->default(0);
            $table->string('product_thumbnail')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('attributes')->nullable();
            $table->unsignedTinyInteger('is_varient')->default(0)->comment('1=>Varient, 0=>Not Varient');
            $table->string('attribute_values')->nullable();
            $table->string('variations')->nullable();
            $table->unsignedTinyInteger('is_featured')->default(0)->comment('1=>Featured, 0=>Not Featured');
            $table->unsignedTinyInteger('is_deals')->default(0)->comment('1=>Deals, 0=>Not Deals');
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
            $table->unsignedTinyInteger('is_approved')->default(1)->comment('1=>Approved, 0=>Not Approved');
            $table->unsignedTinyInteger('is_digital')->default(0)->comment('1=>Digital, 0=>Not Digital');
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
        Schema::dropIfExists('products');
    }
}