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
        ->select('users.name', 'transactions.amount', 'transactions.type')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->paginate(10);
        
        foreach($transactions as $key => $item){
            $transactions[$key]->type = TransactionTypeEnum::getKey($item->type);
        }

        return view('users', ['data' => $transactions]);
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

        return redirect('api/transactions')->with('success', 'Transaction saved!');
    }
}
