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
            $table->text('address')->nullable();
            $table->unsignedBigInteger('city_id');
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
            $table->boolean('is_read')->default(0);
            $table->boolean('is_solved')->default(0);
            $table->timestamps();
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
