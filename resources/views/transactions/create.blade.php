@extends('adminlte::page')

@section('title', 'Transactions')

@section('content_header')
    <h1>Add new Transaction</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <form method="post" action="{{ route('transactions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="type">Type:</label>
                    <select class="form-control" name="type">
                        <option value="1">Debit</option>
                        <option value="0">Credit</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="text" class="form-control" name="amount"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Not mandatory">
                    </div>
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea name="note" id="" cols="30" class="form-control" rows="10" placeholder="Not mandatory"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Transaction</button>
                </form>
            </div>
        </div>
    </div>
@endsection