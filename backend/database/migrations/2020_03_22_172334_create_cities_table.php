<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pincode')->nullable();
            $table->unsignedBigInteger('district_id');
            $table->timestamps();
            $table->foreign('district_id')->references('id')->on('districts');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pincode')->nullable();
            $table->unsignedBigInteger('subdistrict_id');
            $table->timestamps();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('subdistricts');
      Schema::dropIfExists('cities');
    }
}
