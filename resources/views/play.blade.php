@extends('layouts.app')

@section('content')
    {{ $player->name }} played, {{ $player->item }}
    @endsection
