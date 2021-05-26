<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinates', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('total_vaccinations')->nullable();
            $table->integer('people_vaccinated')->nullable();
            $table->integer('people_fully_vaccinated')->nullable();
            $table->integer('daily_vaccinations')->nullable();
            $table->integer('daily_vaccinations_raw')->nullable();
            $table->double('total_vaccinations_per_hundred')->nullable();
            $table->double('people_vaccinated_per_hundred')->nullable();
            $table->double('people_fully_vaccinated_per_hundred')->nullable();
            $table->double('daily_vaccinations_per_million')->nullable();
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
        Schema::dropIfExists('vaccinates');
    }
}
