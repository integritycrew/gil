<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiTokenToUsersTable extends Migration {

    public function up()
    {
        Schema::table('users', function(Blueprint $table) {

            $table->string('api_token',96)->nullable();

        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table) {

            $table->dropColumn('api_token');

        });
    }

}
