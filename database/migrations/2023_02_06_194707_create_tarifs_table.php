<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->id();
            $table->integer( 'zone_id' ); // randomly generated city id will be here
            $table->decimal( 'from_weight', 9 );
            $table->decimal( 'to_weight', 9 );
            $table->decimal( 'price');
            $table->string( 'zone_name' ); // just to show names in Excel file
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
        Schema::dropIfExists('tarifs');
    }
};
