<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student', ['except' => ['login', 'register']]);
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
        $Student = new Student();

        $request -> validate([
            'student_code'              => 'required|unique:students',
            'school_code'               => 'required',
            'first_name'                => 'required',
            'middle_name'               => 'required',
            'last_name'                 => 'required',
            'gender'                    => 'required',
            'date_of_birth'             => 'required',
            'country'                   => 'required',
            'phone'                     => 'required',
            'address'                   => 'required',
            'student_id'                => 'required|unique:students',
            'email'                     => 'required|email|unique:schools',
            'password'                  => 'required|confirmed',
        ]);

        $Student -> student_code        = $request -> student_code;
        $Student -> school_code         = $request -> school_code;
        $Student -> first_name          = $request -> first_name;
        $Student -> middle_name         = $request -> middle_name;
        $Student -> last_name           = $request -> last_name;
        $Student -> gender              = $request -> gender;
        $Student -> date_of_birth       = $request -> date_of_birth;
        $Student -> country             = $request -> country;
        $Student -> picture             = $request -> picture;
        $Student -> phone               = $request -> phone;
        $Student -> address             = $request -> address;
        $Student -> student_id          = $request -> student_id;
        $Student -> current_level       = $request -> current_level;
        $Student -> campus              = $request -> campus;
        $Student -> email               = $request -> email;
        $Student -> password            = bcrypt( $request -> password );

        $Student -> save();

        return response() -> json([
            "status" => "success",
            "code" => 200,
            "message" => "Your registration successful. Check your email.",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show( $student_code )
    {
        return new StudentResource( Student::findOrFail( $student_code ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $student_code )
    {
        $request -> validate([
            'first_name'                => 'required',
            'middle_name'               => 'required',
            'last_name'                 => 'required',
            'gender'                    => 'required',
            'date_of_birth'             => 'required',
            'country'                   => 'required',
            'phone'                     => 'required',
            'address'                   => 'required',
            'student_id'                => 'required',
            'current_level'             => 'required',
            'campus'                    => 'required',
        ]);

        $student = Student:: findOrFail( $student_code );

        if ( $student -> update( $request -> all() ) )
        {
            return response() -> json([
                "status" => "success",
                "code" => 200,
                "message" => "Updated successfully",
            ], 200);
        }

        else
        {
            return response() -> json([
                "status" => "error",
                "code" => 200,
                "message" => "Could not update. Try again later",
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy( Student $student )
    {
        //
    }




    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if ( !$token = auth() -> guard( 'student' ) -> attempt( $credentials ) ) {
            return response() -> json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
