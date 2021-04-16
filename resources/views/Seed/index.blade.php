@extends('layouts.master')

@section('content')
<div class="container-fluid">
   
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Seed Management</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active">Seed Management</li>
            </ol>
        </div>
    </div>

    <div class="row" id="app">
        <div class="col-12">
        <seed-component :user_id="{{Auth::user()->id}}"></seed-component>
        </div>
    </div>

</div>
@endsection
