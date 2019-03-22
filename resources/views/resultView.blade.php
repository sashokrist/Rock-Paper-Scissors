@extends('layouts.app')

@section('content')

  <h2>User played: <strong>{{ $items }}</strong> | Computer played: <strong>{{ $computer }}</strong></h2>
  @if($result == 'Win')
      <h2 style="background: red; font-weight: bold">You Win</h2>
      @elseif($result == 'Tie')
      <h2 style="background: yellow; font-weight: bold">Tie</h2>
  @elseif($result == 'Lost')
      <h2 style="background: black; color: white; font-weight: bold">You Lose</h2>
  @endif

        {{--<h3><a href="{{ url('/') }}" class="btn btn-primary">Play again!</a></h3>--}}
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
    @endsection
