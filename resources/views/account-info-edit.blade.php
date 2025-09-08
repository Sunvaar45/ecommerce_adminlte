@extends('adminlte::page')

@section('title', 'Hesap Ayarları')

@section('content_header')
<h1>Profil Düzenleme</h1>
@stop

@section('content')

<x-success-alert />
<x-error-alert />

<form method="POST" action="{{ route('account-settings.update') }}">
    @csrf

    <div class="form-group">
        <label for="name">İsim</label>
        <x-text-input
            :model="$admin"
            column="name"
        />
    </div>

    <div class="form-group">
        <label for="email">E-posta</label>
        <x-text-input
            :model="$admin"
            column="email"
        />
    </div>

    <div class="form-group">
        <label for="current_password">Mevcut Şifre</label>
        <input type="password"
            name="current_password" id="current_password" class="form-control"
            placeholder="Mevcut Şifre">

        <x-validation-error column="current_password" />

    </div>

    <div class="form-group">
        <label for="password">Yeni Şifre</label>
        <input type="password"
            name="password" id="password" class="form-control"
            placeholder="Yeni Şifre">

        <x-validation-error column="password" />
    </div>

    <x-update-buttons />
</form>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Çıkış Yap</button>
</form>

@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
<link rel="stylesheet" href="/css/table_style.css">
@stop

@section('js')
<script src="/js/hideAlerts.js"></script>
@stop