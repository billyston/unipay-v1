<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function ( Blueprint $table ) {
            $table -> bigIncrements('id');
            $table -> string( 'wallet_code', 15 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string( 'student_code', 15 ) -> comment( "Foreign key code (Relates wallet to student" );
            $table -> string( 'name', 60 ) -> comment( "Name on the momo or card" );
            $table -> string( 'rswitch', 5 ) -> comment( "Type of routing switch (MTN, TGO, ATL, VDF, VIS, MAS, TLA)" );
            $table -> string( 'rswitch_number', 15 ) -> comment( "The Momo or Card number" );
            $table -> string( 'expire_month', 3 ) -> comment( "Card expiry month" );
            $table -> string( 'expire_year', 5 ) -> comment( "Card expiry year" );
            $table -> string( 'cvv', 4 ) -> comment( "Card CVV" );
            $table -> string( 'status', 5 ) -> comment( "Values determines if card is active to be used of transaction" );
            $table -> string( 'verification_attempts', 2 ) -> comment( "Attempts made upon verification" );

            $table -> timestamps();

            $table -> foreign( 'student_code' ) -> references( 'student_code' ) -> on( 'students' ) -> onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
