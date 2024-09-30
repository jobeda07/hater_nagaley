<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 100);
            $table->string('name_bn', 100)->nullable();
            $table->string('slug', 100);
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('image')->nullable();
            $table->integer('parent_id')->default(0);
            $table->unsignedTinyInteger('type')->default(1)->comment('1=>Category, 2=>SubCategory, 3=> SubSubCategory');
            $table->unsignedTinyInteger('is_featured')->default(0)->comment('1=>Featured, 0=>Not Featured');
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
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
        Schema::dropIfExists('categories');
    }
}
