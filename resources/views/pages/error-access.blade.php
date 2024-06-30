@extends('layout')
@section('dashboard')
    active
@endsection
@section('header')
<style>
    .container {
        padding: 1rem;
        min-width: 100%;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="card-body text-center text-gray-800">
        <h1>ERROR ACCESS!</h1>
        <h3>You dont have permission to acces this page!</h3>
    </div>
</div>
@endsection
@section('footer')
@endsection
