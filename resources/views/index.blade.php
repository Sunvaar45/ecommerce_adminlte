@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>E-ticaret Sitesi Admin Paneli</h1>
@stop

@section('content')
    <p>Hoşgeldin, {{ auth()->user()->name ?? 'Admin' }}</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop