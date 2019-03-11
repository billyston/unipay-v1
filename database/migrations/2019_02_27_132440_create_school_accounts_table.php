<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_accounts', function ( Blueprint $table ) {
            $table -> increments('id');
            $table -> string('account_code', 15 ) -> nullable( false ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('school_code', 15 ) -> nullable( false ) -> comment( "Foreign key code (Relates school_account to school)" );
            $table -> string('bank_name', 50 ) -> nullable( false ) -> comment( "School's bank " );
            $table -> string('Bank_branch', 50 ) -> nullable( false ) -> comment( "School's bank branch" );
            $table -> string('country', 50 ) -> nullable( true ) -> comment( "School's bank country" );
            $table -> string('city', 50 ) -> nullable( true ) -> comment( "School's bank city" );
            $table -> string('swift_code', 20 ) -> nullable( false ) -> comment( "School's bank swift code" );
            $table -> string('account_name', 100 ) -> nullable( false ) -> comment( "School's bank account name" );
            $table -> string('account_number', 100 ) -> nullable( false ) -> comment( "School's bank account number" );

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
        Schema::dropIfExists('school_accounts');
    }
}
