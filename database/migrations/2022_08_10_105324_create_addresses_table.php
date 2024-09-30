<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->contrained('users')->onDelete('cascade');
            $table->string('name', 100)->nullable();
            $table->string('division_name',50)->nullable();
            $table->string('district_name',50)->nullable();
            $table->string('upazilla_name',50)->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('upazilla_id')->nullable();
            $table->text('address');
            $table->unsignedTinyInteger('is_default')->default(0)->comment('1=>Default, 0=>Not Default');
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
        Schema::dropIfExists('addresses');
    }
}
