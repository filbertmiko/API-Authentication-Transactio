<?php

namespace App\Http\Controllers;

use App\Models\TransactionItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class TransactionItemController extends Controller
{
    protected $transaction;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->transaction->transaction_items()->get();
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
    public function store(Request $request, Transaction $transaction)
    {
        $request->validate([
            'title' => 'required|string',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $transactionItem = new TransactionItem([
            'title' => $request->get('title'),
            'qty' => $request->get('qty'),
            'price' => $request->get('price'),
            'transaction_id' => $transaction->get('transaction_id')
        ]);

        $transaction->transaction_items()->save($transactionItem);

        return response()->json([
            'message' => 'Transaction Item Added',
            'transaction item' => $transactionItem]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionsItems  $transactionsItems
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionsItems $transactionsItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionsItems  $transactionsItems
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionsItems $transactionsItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionsItems  $transactionsItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionsItems $transactionsItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionsItems  $transactionsItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionsItems $transactionsItems)
    {
        //
    }
}
