@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
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
            <a style="margin: 19px;" href="{{ route('users.create') }}" class="btn btn-primary">New user</a>
            <a style="margin: 19px;" href="{{ route('transactions.index') }}" class="btn btn-primary">Go to tranactions</a>
        </div>
        <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Balance amount</td>
                        <td>Transaction quantity</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result as $key => $item)
                        <tr>
                            <th>{{ $item['user']['name'] }}</th>
                            <th>{{ $item['data'] }}</th>
                            <th>{{ $item['count'] }}</th>
                            <td style="display:flex;">
                                <a class="btn btn-primary" href="{{ route('users.edit',['user' => $item['user']['id']]) }}">Add note</a>
                                @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
@endsection