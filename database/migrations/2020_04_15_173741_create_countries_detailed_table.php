<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesDetailedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries_detailed', function (Blueprint $table) {
            $table->id();
            $table->string('countryCode');
            $table->string('countryName');
            $table->string('currencyCode');
            $table->string('fipsCode');
            $table->string('isoNumeric');
            $table->string('north');
            $table->string('south');
            $table->string('east');
            $table->string('west');
            $table->string('capital');
            $table->string('continentName');
            $table->string('continent');
            $table->string('languages');
            $table->string('isoAlpha3');
            $table->integer('geonameId');

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
        Schema::dropIfExists('countries_detailed');
    }
}
