<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use DB;
use App\Enum\TransactionTypeEnum;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{StoreTransactionRequest, UpdateTransactionRequest};

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        foreach($transactions as $key => $item){
            $transactions[$key]->type = TransactionTypeEnum::getKey($item->type);        
        }

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactions = Transaction::all();

        return view('transactions.create', compact('transactions'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $type = $request->get('type');
        
        $amount = $request->get('amount');
        
        $transaction = new Transaction([
            'user_id' => auth()->user()->id,
            'type' => $type,
            'amount' => $amount
        ]);

        $transaction->save();

        return redirect('transactions')->with('success', 'Transaction saved!');
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        
        return view('transactions.edit', ['transaction' => $transaction]);
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transactionItem = Transaction::find($transaction)->first();
        
        $transactionItem->type = $request->get('type');
        $transactionItem->amount = $request->get('amount');
        
        $transactionItem->save();
        
        return redirect('/transactions')->with('success', 'Transaction updated!');
    }

    public function destroy(Transaction $transaction)
    {
        $transactionItem = Transaction::find($transaction)->first();

        $transactionItem->delete();

        return redirect('/transactions')->with('success', 'Transaction was successfully deleted!');
    }
}
