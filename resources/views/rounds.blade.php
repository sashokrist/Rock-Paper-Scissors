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
        color: black;
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
<table>
    <tr>
        <th>id</th>
        <th>Win</th>
        <th>Victories</th>
    </tr>
    {{ $rounds->count() }}
    {{ auth()->user()->id }}
    @foreach($rounds as $round)
        <tr>
            <td>{{ $round->user_id }}</td>
            <td>{{ $round->win }}</td>
            <td>{{ $round->victories }}</td>
        </tr>
    @endforeach
</table>
    @endsection
