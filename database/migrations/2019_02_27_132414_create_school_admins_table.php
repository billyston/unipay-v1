<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_admins', function ( Blueprint $table ) {
            $table -> increments('id');
            $table -> string('admin_code', 15 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('school_code', 15 ) -> nullable( false )  -> comment( "Foreign key code (Relates school_admin to school)" );
            $table -> string('name', 60 ) -> nullable( false ) -> comment( "School admin name" );
            $table -> string('department', 30 ) -> nullable( true ) -> comment( "School admin's department" );
            $table -> string('position', 30 ) -> nullable( false ) -> comment( "School admin's position" );
            $table -> string('phone', 15 ) -> nullable( false ) -> comment( "School admin's phone" );
            $table -> string('mobile', 15 ) -> nullable( false ) -> comment( "School admin's mobile" );
            $table -> string('email', 50 ) -> nullable( false ) -> unique() -> comment( "School admin's email" );
            $table -> string('password', 200 ) -> comment( "School admin's password" );

            $table -> foreign( 'school_code' ) -> references( 'school_code' ) -> on( 'schools' ) -> onDelete( 'cascade' );

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
        Schema::dropIfExists('school_admins');
    }
}
