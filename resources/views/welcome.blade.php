{{--
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
                            --}}
{{--{{ Form::text('name', '', array('required' => 'required', 'placeholder' => 'your name')) }}--}}{{--

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
--}}
@extends('layouts.app')
<style>
    .suc{
        background: blue;
        color: white;
        font-weight: bold;
    }
    .def{
        background: yellow;
        font-weight: bold;
    }
    .dan{
        background: red;
        color: white;
        font-weight: bold;
    }
    .res{
        display:none;
        margin-top: 50px;
        margin-bottom: 20px;
    }
    #myForm{
        margin-top: 50px;
    }
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
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="{{ asset('images/Rock.png') }}" alt="">
                        <img src="{{ asset('images/Paper.png') }}" alt="">
                        <img src="{{ asset('images/Scissor.png') }}" alt="">
                    </div>
                </div>
                <div class="alert res"><h3>You: </h3></div>
                <div class="col-sm-8">
                    <form id="myForm">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Pick item</label>
                            </div>
                            <select class="custom-select" name="item" id="item">
                                <option selected>Choose...</option>
                                <option value="rock">Rock</option>
                                <option value="paper">Paper</option>
                                <option value="scissors">Scissors</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" id="ajaxSubmit">Play</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
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
                {{ $players->links() }}
            </div>
            </div>
        </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
                e.preventDefault();
                // alert('hi');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/storeAjax/post') }}",
                    method: 'post',
                    data: {
                        name: $('#item').val()
                    },
                    success: function(result){
                        console.log(result.result);
                        //var res = JSON.stringify(result);
                        //var obj = $.parseJSON('{"item": "Win"}' );
                        if( result.result === 'Win'){
                            $('.alert').show();
                            $('.alert').html(result.result).addClass('dan');
                            setTimeout(location.reload.bind(location), 3000);
                        }
                        else if( result.result === 'Lost'){
                            $('.alert').show();
                            $('.alert').html(result.result).addClass('suc');
                            setTimeout(location.reload.bind(location), 3000);
                        }
                        else {
                            $('.alert').show();
                            $('.alert').html(result.result).addClass('def');
                            setTimeout(location.reload.bind(location), 1000);
                        }

                    }}
                );
            });
            //
        });
    </script>
@endsection


