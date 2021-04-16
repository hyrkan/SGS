@extends('layouts.master')

@section('content')

<div class="container-fluid">
   
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
        </div>
    </div>

    <div class="row" id="app">
        <div class="col-12">
            <main-dashboard></main-dashboard>
        </div>
    </div>
</div>


@endsection
