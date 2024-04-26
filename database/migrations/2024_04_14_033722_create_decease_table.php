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
        Schema::create('deceases', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->date("born");
            $table->date("died");
            $table->integer("cemetery_location");
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->string("tax_fullname");
            $table->string("tax_contact");
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
        Schema::dropIfExists('decease');
    }
};
