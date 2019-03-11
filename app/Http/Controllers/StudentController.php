<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student', ['except' => ['login', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        try
        {
            $this -> validate( $request, [
                'school_code'           => 'required',
                'first_name'            => 'required',
                'middle_name'           => 'required',
                'last_name'             => 'required',
                'gender'                => 'required',
                'date_of_birth'         => 'required',
                'country'               => 'required',
                'phone'                 => 'required',
                'address'               => 'required',
                'student_id'            => 'required|unique:students',
                'email'                 => 'required|email|unique:students',
                'password'              => 'required|confirmed',
            ]);

            try
            {
                $Student = new Student( $request -> except( 'password_confirmation' ) );

                if ( $Student -> save() )
                {
                    return response() -> json([
                        'status'        => 'Success',
                        'code'          => 200,
                        'message'       => 'Created successfully'
                    ], 200 );
                }
                else
                {
                    return response() -> json([
                        'status'        => 'Error',
                        'code'          => 200,
                        'message'       => 'Could not create account. Try again later',
                    ], 200 );
                }
            }

            catch ( \Exception $exception )
            {
                return response() -> json([
                    'status'            => 'Error',
                    'code'              => 200,
                    'message'           => 'Something went wrong. Try again later',
                    'reason'            =>  $exception -> errors()
                ], 200 );
            }
        }

        catch ( ValidationException $e )
        {
            return response() -> json([
                "status"                => "validation error",
                "code"                  => 200,
                "message"               => $e -> getMessage(),
                'reason'                => $e -> errors(),
            ], 200 );
        }
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
        try
        {
            $this -> validate( $request, [
                'first_name'        => 'required',
                'middle_name'       => 'required',
                'last_name'         => 'required',
                'gender'            => 'required',
                'date_of_birth'     => 'required',
                'country'           => 'required',
                'phone'             => 'required',
                'address'           => 'required',
                'student_id'        => 'required',
                'current_level'     => 'required',
                'campus'            => 'required',
            ]);

            try
            {
                $student = Student:: findOrFail( $student_code );

                if ( $student -> update( $request -> all() ) )
                {
                    return response() -> json([
                        "status" => "success",
                        "code" => 200,
                        "message" => "Updated successfully",
                    ], 200 );
                }

                else
                {
                    return response() -> json([
                        "status" => "error",
                        "code" => 200,
                        "message" => "Could not update. Try again later",
                    ], 200) ;
                }
            }

            catch ( \Exception $exception )
            {
                return response() -> json([
                    'status'            => 'Error',
                    'code'              => 200,
                    'message'           => 'Something went wrong. Try again later',
                    'reason'            =>  $exception -> errors()
                ], 200 );
            }
        }

        catch ( ValidationException $e )
        {
            return response() -> json([
                'staus'             => 'validation error',
                'code'              => 200,
                'message'           => $e -> getMessage(),
                'reason'            => $e -> errors()
            ], 200 );
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


    // Wallets
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWallet( Request $request )
    {
        return app(\App\Http\Controllers\WalletController::class ) -> store( $request );
    }

    // Transactions
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTransaction( Request $request )
    {
        return app(\App\Http\Controllers\TransactionController::class ) -> store( $request );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function transactions( Request $request, $student_code )
    {
//        return app(\App\Http\Controllers\TransactionController::class ) -> store( $request );
    }


    // JWT Authentication
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
