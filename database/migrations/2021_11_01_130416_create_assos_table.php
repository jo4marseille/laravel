<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('logo');
            $table->text('description');
            $table->string('indicator_label_1');
            $table->integer('indicator_value_1');
            $table->string('indicator_unit_1', 5);
            $table->string('indicator_label_2')->nullable();
            $table->integer('indicator_value_2')->nullable();
            $table->string('indicator_unit_2', 5)->nullable();
            $table->string('indicator_label_3')->nullable();
            $table->integer('indicator_value_3')->nullable();
            $table->string('indicator_unit_3', 5)->nullable();
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
        Schema::dropIfExists('assos');
    }
}
