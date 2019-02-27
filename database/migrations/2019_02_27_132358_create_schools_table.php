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
        Schema::create('schools', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('school_code', 15 ) -> unique();
            $table -> string('name', 50 );
            $table -> string('country', 50 );
            $table -> string('city', 50 );
            $table -> string('state', 50 );
            $table -> string('postal_code', 10 );
            $table -> string('street_address', 100 );
            $table -> string('phone', 15 );
            $table -> string('fax', 15 );
            $table -> string('mobile', 15 );
            $table -> string('email' ) -> unique();
            $table -> integer('population' );
            $table -> text('about' );
            $table -> string('logo', 150 );
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
