<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register( Request $request )
    {
        $school = new School();

        $request -> validate([
            'school_code'               => 'required|unique:schools',
            'name'                      => 'required',
            'country'                   => 'required',
            'city'                      => 'required',
            'mobile'                    => 'required',
            'email'                     => 'required|email|unique:schools',
            'logo'                      => 'required',
        ]);

        $school -> school_code          = $request -> school_code;
        $school -> name                 = $request -> name;
        $school -> country              = $request -> country;
        $school -> city                 = $request -> city;
        $school -> state                = $request -> state;
        $school -> postal_code          = $request -> postal_code;
        $school -> street_address       = $request -> street_address;
        $school -> phone                = $request -> phone;
        $school -> fax                  = $request -> fax;
        $school -> mobile               = $request -> mobile;
        $school -> email                = $request -> email;
        $school -> population           = $request -> population;
        $school -> about                = $request -> about;
        $school -> logo                 = $request -> logo;

        $school -> save();

        return response() -> json([
            "status" => "success",
            "code" => 200,
            "message" => "Registration successful",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show( School $school )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, School $school )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
