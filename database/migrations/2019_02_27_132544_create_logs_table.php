<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('log_code', 15 ) -> unique();
            $table -> string('transaction_code', 15 );
            $table -> text('data' );

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
        Schema::dropIfExists('logs');
    }
}
