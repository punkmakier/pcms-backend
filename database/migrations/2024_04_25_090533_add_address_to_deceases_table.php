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
        Schema::table('deceases', function (Blueprint $table) {
            $table->string("lapida_image");
            $table->string("address")->nullable();
            $table->string("niche")->nullable();
            $table->string("constructions")->nullable();
            $table->string("excavation")->nullable();
            $table->date("date_of_permit")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deceases', function (Blueprint $table) {
            //
        });
    }
};
