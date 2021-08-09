<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
Use App\Models\TransactionItem;
Use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    protected $transaction;
    protected $user;

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()['id'];
        $transactions = Transaction::where('transactions.user_id', 'like', $user_id)->paginate(5);
        
        //auth()->user()->transactions()->whereIn('id', $user_id)->paginate(5);
 
        return response()->json(['transactions'=>$transactions]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate Data
        $data = $request->only('total_amount', 'paid_amount', 'payment_method');
        $validator = Validator::make($data, [
            'total_amount' => 'required',
            'paid_amount' => 'required',
            'payment_method' => 'required'
        ]);

        //Send failed response if request is invalid
        if ($validator->fails()){
            return response()->json([
                'error' => $validator->messages()], 200);
        }

        //If Request is valid then store the transaction
        $total_amount = $request->total_amount;
        $paid_amount = $request->paid_amount;

        //Get Change Amount        
        $change_amount = $paid_amount - $total_amount;
        $dts = date('Y-m-d H:i:s');//Carbon::now()->toDateTimeString();
   
        $transaction = Transaction::create([
            'user_id' => auth()->user()['id'],
            'uuid' => Str::uuid()->toString(),
            'device_timestamp' => date('Y-m-d H:i:s'),
            'total_amount' => $total_amount,
            'paid_amount' => $paid_amount,
            'change_amount' => $change_amount,
            'payment_method' => $request->payment_method
        ]);
        
       
        //Transaction created, return success response
        auth()->user()->transactions()->save($transaction);
        return response()->json([
            'message' => 'transaction added',
            'transaction' => $transaction
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $user_id = auth()->user()['id'];
        $transactions = TransactionItem::where('transaction_items.transaction_id', 'like', $transaction->id)->paginate(5);
        
        //auth()->user()->transactions()->whereIn('id', $user_id)->paginate(5);
 
        return response()->json(['transactions'=>$transactions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        if (auth()->user()['id'] !==  $transaction->user_id) {
            return response()->json(['message' => 'Action Forbidden']);
        }

        $transaction->delete();
        return response()->json(['message'=>'Transaction successfully deleted']);
    }
}
