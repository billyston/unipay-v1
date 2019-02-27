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
        Schema::create('school_accounts', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('account_code', 15 ) -> unique();
            $table -> string('school_code', 15 );
            $table -> string('bank_name', 50 );
            $table -> string('Bank_branch', 50 );
            $table -> string('country', 50 );
            $table -> string('city', 50 );
            $table -> string('swift_code', 20 );
            $table -> string('account_name', 100 );
            $table -> string('account_number', 100 );

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
