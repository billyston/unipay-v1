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
            $table -> string('transaction_code', 15 ) -> unique();
            $table -> string('student_code', 15 );
            $table -> string('payment_type', 40 );
            $table -> decimal('transacted_amount', 9,2 );
            $table -> decimal('transaction_charge', 9,2 );
            $table -> decimal('total_amount', 9,2 );
            $table -> integer('reference_number' );
            $table -> char('rswitch', 4 );
            $table -> string( 'rswitch_number', 40 );
            $table -> string( 'expire_month', 3 );
            $table -> string( 'expire_year', 5 );
            $table -> string( 'cvv', 3 );
            $table -> text( 'transaction_desc' );
            $table -> timestamp( 'transaction_date' );
            $table -> string( 'token', 20 );
            $table -> string( 'transaction_status', 5 );

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
