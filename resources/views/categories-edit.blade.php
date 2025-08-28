@extends('adminlte::page')

@section('title', 'Kategori Düzenle')

@section('content_header')
    <h1>Kategori Düzenle</h1>
@stop

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('categories.update') }}">
    @csrf

    <table class="table table-bordered" id="categories-table">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
                <th>Sil / Ekle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $i => $category)
                @php
                    $namePrefixBracket = 'categories[' . $i . ']';
                    $namePrefixDot = 'categories.' . $i . '.';
                @endphp
                <tr>
                    <td>
                        <x-id-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :model="$category"
                        />
                    </td>
                    <td>
                        <x-text-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'name'"
                            :model="$category"
                            :required="true"
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
            @endforeach
            <tr>
                <td>Yeni</td>
                <td>
                    <x-text-input 
                        :column="'new_name'"
                        :model="null"
                        :required="false"
                    />
                </td>
                <td><strong>Pasif</strong></td>
                <td>
                    <x-add-button />
                </td>
            </tr>
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