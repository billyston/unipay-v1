<?php

namespace App\Http\Controllers;

use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WalletController extends Controller
{
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
                'student_code'          => 'required',
                'name'                  => 'required',
                'rswitch'               => 'required',
                'rswitch_number'        => 'required',
                'expire_month'          => 'required',
                'expire_year'           => 'required',
                'cvv'                   => 'required',
            ]);

            try
            {
                $wallet = new Wallet( $request -> all() );

                if ( $wallet -> save() )
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
                    'reason'            =>  $exception -> getMessage()
                ], 200 );
            }
        }

        catch ( ValidationException $exception )
        {
            return response() -> json([
               'status'                 => 'Error',
               'code'                   => 200,
               'message'                => $exception -> getMessage(),
               'reason'                 => $exception -> errors(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show( $wallet_code )
    {
        return new WalletResource( Wallet::findOrFail( $wallet_code ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Wallet $wallet )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy( Wallet $wallet )
    {
        //
    }
}
