<?php

namespace App\Http\Controllers;

use App\Models\School;
use Dotenv\Exception\ValidationException;
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
        $this->middleware('auth:api', ['except' => ['store']]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store( Request $request )
    {
        try
        {
            $this -> validate( $request, [
                'name'              => 'required',
                'country'           => 'required',
                'city'              => 'required',
                'mobile'            => 'required',
                'email'             => 'required|email|unique:schools',
                'logo'              => 'required',
            ]);

            try
            {
                $school = new School( $request -> all() );

                if ( $school -> save() )
                {
                    return response() -> json([
                        "status"    => "success",
                        "code"      => 200,
                        "message"   => "Created successfully",
                    ], 200);
                }

                else
                {
                    return response() -> json([
                        "status"    => "error",
                        "code"      => 200,
                        "message"   => "Could not create account. Try again later",
                    ], 200);
                }
            }

            catch ( \Exception $exception )
            {
                logger( $exception -> getMessage() );

                return response() -> json([
                    "status"        => "error",
                    "code"          => 200,
                    "message"       => "Something went wrong. Try again later",
                ], 200);
            }
        }
        catch ( ValidationException $e )
        {
            return response() -> json([
                "status"            => "validation error",
                "code"              => 200,
                "message"           => $e -> getMessage(),
            ], 200);
        }
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
