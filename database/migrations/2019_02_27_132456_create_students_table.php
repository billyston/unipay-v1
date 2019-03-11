<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('student_code', 15 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('school_code', 15 ) -> comment( "Foreign key code (Relates student to school" );
            $table -> string('first_name', 40 ) -> comment( "Student's first name" );
            $table -> string('middle_name', 40 ) -> comment( "Student's middle name" );
            $table -> string('last_name', 40 ) -> comment( "Student's last name" );
            $table -> string('gender', 10 ) -> comment( "Student's gender" );
            $table -> date('date_of_birth' ) -> comment( "Student's date of birth" );
            $table -> string('country', 50 ) -> comment( "Student's country" );
            $table -> string('picture', 255 ) -> nullable( true ) -> comment( "Student's photo" );
            $table -> string('phone', 15 ) -> comment( "Student's phone" );
            $table -> string('address', 100 ) -> comment( "Student's address" );
            $table -> string('student_id', 20 ) -> comment( "Student's school id" );
            $table -> string('current_level', 30 ) -> comment( "Student's current level" );
            $table -> string('campus', 50 ) -> comment( "Student's campus" );
            $table -> string('email', 50 ) -> comment( "Student's email" );
            $table -> string('password', 200 ) -> comment( "Student's password" );

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
        Schema::dropIfExists('students');
    }
}
