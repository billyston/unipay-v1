<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('code', 15 ) -> unique();
            $table -> string('name', 60 );
            $table -> string('department', 30 );
            $table -> string('position', 30 );
            $table -> string('phone', 15 );
            $table -> string('mobile', 15 );
            $table -> string('email', 50 ) -> unique();
            $table -> string('password', 200 );
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
