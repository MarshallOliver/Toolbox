<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignageElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signage_elements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('class');
            $table->integer('x_coord');
            $table->integer('y_coord');
            $table->string('background');
            $table->string('color');
            $table->string('height');
            $table->string('width');
            $table->string('value');
            $table->string('border');
            $table->string('font_family');
            $table->string('font_weight');
            $table->foreignId('signage_id')
                ->constrained('signage')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signage_elements');
    }
}
