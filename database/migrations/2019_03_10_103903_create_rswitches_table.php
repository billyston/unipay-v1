<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRswitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rswitches', function ( Blueprint $table ) {
            $table -> bigIncrements('id' );
            $table -> string('rswitch_code', 10 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('name', 30 ) -> comment( "Name on the momo or card" );
            $table -> string('nick_name', 5 ) -> comment( "Abbreviated name for rswitch (MTN, TGO, ATL, VDF, VIS, MAS, TLA)" );
            $table -> string('image', 100 ) -> comment( "Logo of the rswitch" );
            $table -> string('description', 200 ) -> comment( "Describes the rswitch" );

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
        Schema::dropIfExists('rswitches');
    }
}
