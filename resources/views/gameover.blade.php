@extends('layouts.app')

@section('content')
<h3>GAME OVER</h3>
@if (Session::has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @endsection
