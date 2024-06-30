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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="card">
        <div class="card-body text-center">
            <h3>Selamat Datang {{ Auth::user()->name }}</h3>
        </div>
    </div>
</div>
@endsection
@section('footer')
@endsection
