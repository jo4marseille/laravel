<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAssosLanding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assos', function (Blueprint $table) {
            // add slug
            $table->string('slug')->after('name');
        });

        Schema::table('sites', function (Blueprint $table) {
            // remove slug
            $table->dropColumn('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assos', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('sites', function (Blueprint $table) {
            $table->string('slug')->after('id');
        });
    }
}
