@extends('adminlte::page')

@section('title', 'Site İçeriğini Düzenle')

@section('content_header')
    <h1>Favicon ve Başlık</h1>
@stop

@section('content')

<x-success-alert />

<form method="POST" action="{{ route('favicon-and-title.update') }}">
    @csrf

    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if ($faviconAndTitle)
                <tr>
                    <x-id-input 
                        :model="$faviconAndTitle"
                    />
                    <td>
                        <x-image-upload 
                            :model="$faviconAndTitle"
                            :column="'favicon'"
                            :maxWidth="'100px'"
                            :imageDir="'images/favicon/'"
                        />
                    </td>
                    <td>
                        <x-toggle-state 
                            :table="'categories'"
                            :model="$category"
                        />
                    </td>
                    <td>
                        <x-remove-button 
                            :table="'categories'"
                            :model="$category"
                        />                   
                    </td>
                </tr>
            @endif
        </tbody>

    </table>

    <x-update-buttons />
</form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="/css/table_style.css">
@stop

@section('js')
<script src="{{ asset('js/hideAlerts.js') }}"></script>

@stop