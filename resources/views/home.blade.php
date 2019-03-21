@extends('layouts.app')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>You are logged as <strong>{{ Auth::user()->name }}</strong></h2>
                        <a href="/" class="btn btn-primary">Play</a>

                    <h3>Your Statistic</h3>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Your choice</th>
                                <th>PC choice</th>
                                <th>Winner</th>
                                <th>Date</th>
                            </tr>
                            @foreach($players as $player)
                            <tr>
                                <td>{{ $player->name }}</td>
                                <td>{{ $player->item }}</td>
                                <td>{{ $player->computer }}</td>
                                <td>{{ $player->win }}</td>
                                <td>{{ $player->updated_at }}</td>
                            </tr>
                            @endforeach
                        </table>
                </div>
            </div>
        </div>
        <div>
            <h3>User Options</h3>
            <div>
                {{ Form::open(array('action' => 'GameController@userOptions', 'method' => 'post')) }}
                {{ Form::select('item', array('rock' => 'Rock', 'paper' => 'Paper', 'scissors' => 'Scissors'), '', array('class' => 'form-control')) }}
                {{ Form::submit('Play', array('class' => ' btn btn-primary form-control')) }}<br>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
