@extends('adminlte::page')

@section('title', 'Transactions')

@section('content_header')
    <h1>Transactions</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <div>
            <a style="margin: 19px;" href="{{ route('transactions.create')}}" class="btn btn-primary">New transaction</a>
        </div>
        <div class="col-sm-12">
                <table class="table table-striped">
            
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Transaction amount</td>
                    <td>Transaction type</td>
                    <td colspan=2>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($transactions as $value)
                    <tr>
                        <th>{{ $value->name }}</th>
                        <th>{{ $value->amount }}</th>
                        <th>{{ $value->type }}</th>
                        <td style="display:flex;">
                        <a href="" class="btn btn-primary">Edit</a>
                        <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
               
        
                </tbody>
            </table>
            {{ $transactions->links() }}
        </div>
    </div>
@endsection