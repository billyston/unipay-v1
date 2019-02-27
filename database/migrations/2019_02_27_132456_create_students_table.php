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
            $table -> string('student_code', 15 ) -> unique();
            $table -> string('school_code', 15 );
            $table -> string('first_name', 40 );
            $table -> string('middle_name', 40 );
            $table -> string('last_name', 40 );
            $table -> string('gender', 10 );
            $table -> date('date_of_birth' );
            $table -> string('country', 50 );
            $table -> string('picture', 150 );
            $table -> string('phone', 15 );
            $table -> string('address', 100 );
            $table -> string('school_id', 20 );
            $table -> string('current_level', 30 );
            $table -> string('campus', 50 );
            $table -> string('email', 50 );
            $table -> string('password', 200 );

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
