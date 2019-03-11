<?php

namespace App\Http\Controllers;

use App\Http\Resources\SchoolAdminResource;
use App\Models\SchoolAdmin;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class SchoolAdminController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:school', ['except' => ['login', 'store']]);
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
    public function store( Request $request )
    {
        try
        {
            $this -> validate( $request, [
                'school_code'       => 'required',
                'name'              => 'required',
                'department'        => 'required',
                'position'          => 'required',
                'mobile'            => 'required',
                'email'             => 'required|email|unique:school_admins',
                'password'          => 'required|confirmed'
            ]);

            try
            {
                $schoolAdmin = new SchoolAdmin( $request -> except( 'password_confirmation' ) );

                if ( $schoolAdmin -> save() )
                {
                    return response() -> json([
                        'status'    => 'Success',
                        'code'      => 200,
                        "message"   => "Created successfully",
                    ], 200 );
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
     * @param  \App\Models\SchoolAdmin  $schoolAdmin
     * @return \Illuminate\Http\Response
     */
    public function show( $admin_code )
    {
        return new SchoolAdminResource( SchoolAdmin::findOrFail( $admin_code ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\SchoolAdmin $schoolAdmin
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function update( Request $request, $admin_code )
    {
        try
        {
            $this -> validate( $request, [
                'name'              => 'required',
                'department'        => 'required',
                'position'          => 'required',
                'phone'             => 'required',
                'mobile'            => 'required',
            ]);

            try
            {
                $admin = SchoolAdmin:: findOrFail( $admin_code );

                if ( $admin -> update( $request -> all() ) )
                {
                    return response() -> json([
                        "status"    => "success",
                        "code"      => 200,
                        "message"   => "Updated successfully",
                    ], 200);
                }
                else
                {
                    return response() -> json([
                        "status"    => "error",
                        "code"      => 200,
                        "message"   => "Could not update. Try again later",
                    ], 200);
                }
            }

            catch ( \Exception $exception )
            {
                return response() -> json([
                    "status"        => "error",
                    "code"          => 200,
                    "message"       => "Something went wrong. Try again later",
                ], 200 );
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolAdmin  $schoolAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy( SchoolAdmin $schoolAdmin )
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

        if ( !$token = auth() -> guard( 'school' ) -> attempt( $credentials ) ) {
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
