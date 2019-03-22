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
</style>
@section('content')
    <div class="container">
        <div class="col-sm-10 justify-content-center">
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
                        }
                        else if( result.result === 'Lost'){
                            $('.alert').show();
                            $('.alert').html(result.result).addClass('suc');
                        }
                         else {
                            $('.alert').show();
                            $('.alert').html(result.result).addClass('def');
                        }

                    }}
                    );
            });
        });
    </script>
    @endsection

