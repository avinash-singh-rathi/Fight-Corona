<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('subdistrict_id');
            $table->unsignedBigInteger('city_id');
            $table->string('cityname')->nullable();
            $table->integer('pincode')->nullable();
            $table->json('symptoms');
            $table->text('message')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('gcity')->nullable();
            $table->string('gdistrict')->nullable();
            $table->string('gstate')->nullable();
            $table->string('gpin')->nullable();
            $table->string('gcountry')->nullable();
            $table->unsignedBigInteger('lostpatient_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_read')->default(0);
            $table->boolean('is_solved')->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
