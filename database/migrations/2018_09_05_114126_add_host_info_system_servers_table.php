<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHostInfoSystemServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_servers', function (Blueprint $table) {
            $table->string('host')->after('site');
            $table->integer('port')->after('host');
            $table->string('username')->after('port');
            $table->string('password')->after('username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_servers', function (Blueprint $table) {
            //
        });
    }
}
