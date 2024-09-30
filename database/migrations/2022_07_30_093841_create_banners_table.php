<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title_en', 50);
            $table->string('title_bn', 50)->nullable();
            $table->string('banner_img')->nullable();
            $table->string('banner_url', 100)->default('#');
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('position')->default(1)->comment('1=>Home Banner, 0=>Footer Banner');
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
        Schema::dropIfExists('banners');
    }
}
