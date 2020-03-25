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
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('district_id');
            //$table->unsignedBigInteger('city_id');
            $table->string('city');
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
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('district_id')->references('id')->on('districts');
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
