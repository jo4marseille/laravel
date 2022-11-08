<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('image');
            $table->string('link');
            $table->text('description');
            $table->string('video')->nullable();
            $table->boolean('status')->default(false);
            $table->string('git_depo');
            $table->text('desc_techno');
            $table->string('app_link_android')->nullable();
            $table->string('app_link_ios')->nullable();
            $table->foreignId('asso_id');
            $table->timestamps();

        });

        Schema::table('sites', function($table) {
            $table->foreign('asso_id')->references('id')->on('assos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
