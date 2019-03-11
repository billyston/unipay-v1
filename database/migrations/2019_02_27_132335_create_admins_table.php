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
        Schema::create('admins', function ( Blueprint $table ) {
            $table -> increments('id');
            $table -> string('code', 15 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('name', 60 ) -> nullable( false ) -> comment( "The name of the admin user" );
            $table -> string('department', 30 ) -> nullable( true ) -> comment( "Department of the admin user" );
            $table -> string('position', 30 ) -> nullable( true ) -> comment( "The position of the admin user" );
            $table -> string('phone', 15 ) -> nullable( true ) -> comment( "Phone of the admin user" );
            $table -> string('mobile', 15 ) -> nullable( false ) -> comment( "Mobile of the admin user" );
            $table -> string('email', 50 ) -> unique() -> nullable( false ) -> comment( "Email of the admin user" );
            $table -> string('password', 200 ) -> comment( "Chosen password of the admin user" );
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
