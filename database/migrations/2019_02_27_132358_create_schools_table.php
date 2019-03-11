<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function ( Blueprint $table ) {
            $table -> increments('id');
            $table -> string('school_code', 15 ) -> unique() -> comment( "Unique code as a primary key" );
            $table -> string('name', 50 ) -> nullable( false ) -> comment( "Name of the school" );
            $table -> string('country', 50 ) -> nullable( false ) -> comment( "Country of school" );
            $table -> string('city', 50 ) -> nullable( true ) -> comment( "The city of the school" );
            $table -> string('state', 50 ) -> nullable( true ) -> comment( "State of the school" );
            $table -> string('postal_code', 10 ) -> nullable( true ) -> comment( "Postal code of the school" );
            $table -> string('street_address', 100 ) -> nullable( false ) -> comment( "Address (Location) of the school" );
            $table -> string('phone', 15 ) -> nullable( false ) -> comment( "School phone" );
            $table -> string('fax', 15 ) -> nullable( true ) -> comment( "School fax" );
            $table -> string('mobile', 15 ) -> nullable( true ) -> comment( "School mobile" );
            $table -> string('email' ) -> unique() -> nullable( false ) -> comment( "School's email" );
            $table -> integer('population' ) -> nullable( true ) -> comment( "The population of the school" );
            $table -> text('about' ) -> nullable( true ) -> comment( "History of the school" );
            $table -> string('logo', 150 ) -> nullable( true ) -> comment( "School loco" );
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
        Schema::dropIfExists('schools');
    }
}
