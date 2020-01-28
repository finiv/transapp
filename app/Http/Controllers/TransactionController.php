<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use App\Enum\TransactionTypeEnum;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transactions')
        ->select('users.id', 'users.name', 'transactions.amount', 'transactions.type')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->orderBy('transactions.created_at', 'desc')
        ->paginate(5);
        
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
            'user_id' => 1,
            'type' => $type,
            'amount' => $amount
        ]);

        $transaction->save();

        return redirect('transactions')->with('success', 'Transaction saved!');
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        // todo pass id to view
        return view('transactions.edit', ['transaction' => $transaction]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $transaction = Transaction::find($transaction);
        $transaction->save(); // todo complete update
        return redirect('/transactions')->with('success', 'Transaction updated!');
    }
}
