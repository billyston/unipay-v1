<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Admin::latest() -> get();
//        return new AdminResource( Admin::latest() -> get() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        $admin = new Admin();

        $request -> validate([
            'code'                  => 'required|unique:admins',
            'mobile'                => 'required',
            'name'                  => 'required',
            'email'                 => 'required|email|unique:admins',
            'password'              => 'required|confirmed',
        ]);

        $admin -> code              = $request -> code;
        $admin -> name              = $request -> name;
        $admin -> department        = $request -> department;
        $admin -> position          = $request -> position;
        $admin -> phone             = $request -> phone;
        $admin -> mobile            = $request -> mobile;
        $admin -> email             = $request -> email;
        $admin -> password          = bcrypt( $request -> password );

        try
        {
            $admin -> save();
            return response() -> json([
                "status" => "success",
                "code" => 200,
                "message" => "Created successfully",
            ], 200);
        }

        catch (Exception $e)
        {
            return response() -> json([
                "status" => "error",
                "code" => 200,
                "message" => "Could not create account. Try again later",
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show( $code )
    {
        return new AdminResource( Admin::findOrFail( $code ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $code )
    {
        $request -> validate([
            'name'                  => 'required',
            'department'            => 'required',
            'position'              => 'required',
            'phone'                 => 'required',
            'mobile'                => 'required',
        ]);

        $admin = Admin::findOrFail( $code );

        if ( $admin -> update( $request -> all() ) )
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy( Admin $admin )
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

        if ( !$token = auth() -> guard( 'api' ) -> attempt( $credentials ) ) {
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
