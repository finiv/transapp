<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User, Note, Transaction};
use DB;
use App\Enum\TransactionTypeEnum;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{StoreTransactionRequest, UpdateTransactionRequest};

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-delete', ['only' => ['index','show']]);
         $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
         $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    }

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
        $title = isset($request->title) ? $request->get('title') : null;
        $note = isset($request->note) ? $request->get('note') : null;
        
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'type' => $type,
            'amount' => $amount,
            'note' => $note
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
        $transactionItem->note = isset($request->note) ? $request->get('note') : null;

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
