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
            $table -> string('name', 50 ) -> comment( "Name of the school" );
            $table -> string('country', 50 ) -> comment( "Country of school" );
            $table -> string('city', 50 ) -> comment( "The city of the school" );
            $table -> string('state', 50 ) -> comment( "State of the school" );
            $table -> string('postal_code', 10 ) -> comment( "Postal code of the school" );
            $table -> string('street_address', 100 ) -> comment( "Address (Location) of the school" );
            $table -> string('phone', 15 ) -> comment( "School phone" );
            $table -> string('fax', 15 ) -> comment( "School fax" );
            $table -> string('mobile', 15 ) -> comment( "School mobile" );
            $table -> string('email' ) -> unique() -> comment( "School's email" );
            $table -> integer('population' ) -> comment( "The population of the school" );
            $table -> text('about' ) -> comment( "History of the school" );
            $table -> string('logo', 150 ) -> comment( "School loco" );
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
