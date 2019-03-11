<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('issue_code', 15 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('student_code', 15 ) -> comment( "Foreign key code (Relates issue to student" );
            $table -> string('transaction_code', 15 ) -> comment( "Foreign key code (Relates issue to transaction" );
            $table -> text('issue' ) -> comment( "The details of the issue" );

            $table -> foreign( 'student_code' )     -> references( 'student_code' )     -> on( 'students' )     -> onDelete( 'cascade' );
            $table -> foreign( 'transaction_code' ) -> references( 'transaction_code' ) -> on( 'transactions' ) -> onDelete( 'cascade' );

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
        Schema::dropIfExists('issues');
    }
}
