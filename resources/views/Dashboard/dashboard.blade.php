@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Dashboard</h1>
                <p>Selamat datang, {{ Auth::user()->name }}</p>
            </div>


        </div>
    </div>
@endsection
