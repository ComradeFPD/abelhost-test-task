<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCakesComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cakes_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cake_id');
            $table->unsignedBigInteger('component_id');
            $table->timestamps();
            $table->foreign('cake_id')->references('id')->on('cakes')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('component_id')->references('id')->on('components')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cakes_components');
    }
}
