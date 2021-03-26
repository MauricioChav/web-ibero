<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersIdToProjectsAndTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->nullable()->unsigned();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
