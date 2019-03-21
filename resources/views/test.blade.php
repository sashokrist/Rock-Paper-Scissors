@extends('layouts.app')

@section('content')

    <h2>User played: <strong>{{ $items }}</strong> | Computer played: <strong>{{ $computer }}</strong></h2>
    @if($items == 'scissors' && $computer == 'paper' ||
            $items == 'paper' && $computer == 'rock' ||
            $items == 'rock' && $computer == 'scissors')
        <h2 style="background: red; font-weight: bold">You Win</h2>
    @endif

    @if($computer == 'scissors' && $items == 'paper' ||
        $computer == 'paper' && $items == 'rock' ||
        $computer == 'rock' && $items == 'scissors')
        <h2 style="background: black; color: white; font-weight: bold">You Lose</h2>
    @endif

    @if($items == $computer)
        <h2 style="background: yellow; font-weight: bold">Tie</h2>
    @endif
    @endsection
