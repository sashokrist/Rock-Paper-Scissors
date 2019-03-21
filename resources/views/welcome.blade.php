@extends('layouts.app')

@section('content')
            <div class="content">
                <div class="title m-b-md">
                    <h2>Rock Paper Scissors</h2>
                    <h3>You are logged as <strong>{{ Auth::user()->name }}</strong></h3>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{ asset('images/Rock.png') }}" alt="">
                        <img src="{{ asset('images/Paper.png') }}" alt="">
                        <img src="{{ asset('images/Scissor.png') }}" alt="">
                    </div>
                </div>
                <div class="row" style="padding-top: 100px; padding-bottom: 20px;">
                        <div class="col-sm-12">
                            {{ Form::open(array('action' => 'GameController@store', 'method' => 'post')) }}
                            {{--{{ Form::text('name', '', array('required' => 'required', 'placeholder' => 'your name')) }}--}}
                            <div class="d-flex justify-content-center">
                                <div class="col-sm-4">
                                    {{ Form::select('item', array('rock' => 'Rock', 'paper' => 'Paper', 'scissors' => 'Scissors'), '', array('class' => 'form-control')) }}
                                </div>
                                <div class="col-sm-4">
                                    {{ Form::submit('Play', array('class' => ' btn btn-primary form-control')) }}<br>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection
