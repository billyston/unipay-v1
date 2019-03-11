<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('transaction_code', 15 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('student_code', 15 ) -> nullable( false ) -> comment( "Foreign key code (Relates transaction to student" );
            $table -> string('payment_type', 40 ) -> nullable( false ) -> comment( "Type of payment" );
            $table -> decimal('transacted_amount', 9,2 ) -> nullable( false ) -> comment( "Transaction amount" );
            $table -> decimal('transaction_charge', 9,2 ) -> nullable( false ) -> comment( "Transaction charge" );
            $table -> decimal('total_amount', 9,2 ) -> nullable( false ) -> comment( "Transaction total amount" );
            $table -> string('reference_number', 15 ) -> nullable( false ) -> comment( "Transaction reference number" );
            $table -> char('rswitch', 4 ) -> nullable( false ) -> comment( "Transaction payment medium (Rswitch)" );
            $table -> string( 'rswitch_number', 40 ) -> nullable( false ) -> comment( "The rswitch number" );
            $table -> string( 'expire_month', 3 ) -> nullable( true ) ->default(null ) -> comment( "Card expiry month" );
            $table -> string( 'expire_year', 5 ) -> nullable( true ) ->default(null ) -> comment( "Card expiry year" );
            $table -> string( 'cvv', 3 ) -> nullable( true ) ->default(null ) -> comment( "Card CVV" );
            $table -> text( 'transaction_desc' ) -> comment( "Description of the transaction" );
            $table -> string( 'token', 20 ) -> nullable( true ) ->default( null ) -> comment( "Token generated after successful payment" );
            $table -> string( 'transaction_status', 4 ) -> nullable( true ) ->default( 100 ) -> comment( "The status of the transaction" );

            $table -> foreign( 'student_code' ) -> references( 'student_code' ) -> on( 'students' ) -> onDelete( 'cascade' );

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
        Schema::dropIfExists('transactions');
    }
}
