<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::latest() -> get();
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
                'payment_type'              => 'required',
                'transacted_amount'         => 'required',
                'transaction_charge'        => 'required',
                'total_amount'              => 'required',
                'transaction_desc'          => 'required',
            ] );

            try
            {
                $transaction = new Transaction( $request -> all() );

                if ( $transaction -> save() )
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
                        'message"   => "Could not create account. Try again later',
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
                "status"            => "validation error",
                "code"              => 200,
                "message"           => $exception -> getMessage(),
                'reason'            => $exception -> errors(),
            ], 200 );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show( Transaction $transaction )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit( Transaction $transaction )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Transaction $transaction )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy( Transaction $transaction )
    {
        //
    }
}
