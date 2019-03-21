@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" style="display:none"></div>
        <form id="myForm">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                </div>
                <select class="custom-select" name="item" id="item">
                    <option selected>Choose...</option>
                    <option value="rock">Rock</option>
                    <option value="paper">Paper</option>
                    <option value="scissors">Scissors</option>
                </select>
            </div>
            <button class="btn btn-primary" id="ajaxSubmit">Submit</button>
        </form>
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
                jQuery.ajax({
                    url: "{{ url('/storeAjax/post') }}",
                    method: 'post',
                    data: {
                        name: jQuery('#item').val()
                    },
                    success: function(result){
                        jQuery('.alert').show();
                        jQuery('.alert').html(result.success);
                        console.log(result);
                    }});
            });
        });
    </script>
    @endsection
