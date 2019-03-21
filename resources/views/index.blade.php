@extends('layouts.app')

@section('content')
    <h2>RPS</h2>
    @foreach($players as $player)
      Name:  {{ $player->name }}<br>
       Choose: <a href="/game/{{ $player->id }}">{{ $player->item }}</a><br>
        Result: {{ $player->win }}<br>
    @endforeach
    {{ $players->links() }}
    @endsection
