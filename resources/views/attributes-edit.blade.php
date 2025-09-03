@extends('adminlte::page')

@section('title', 'Özellikleri Düzenle')

@section('content_header')
    <h1>Özellikleri Düzenle</h1>
@stop

@section('content')

<x-success-alert />

<form method="POST" action="{{ route('attributes.update') }}">
    @csrf

    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
                <th>Sil / Ekle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes as $i => $attribute)
                @php
                    $namePrefixBracket = 'attributes[' . $i . ']';
                    $namePrefixDot = 'attributes.' . $i . '.';
                @endphp
                <tr>
                    <td>
                        <x-id-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :model="$attribute"
                        />
                        {{ $attribute->id }}
                    </td>
                    <td> {{-- name --}}
                        <x-text-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'name'"
                            :model="$attribute"
                            :required="false"
                        />
                    </td>
                    <td> {{-- type --}}
                        <x-dropdown-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'type'"
                            :model="$attribute"
                            :options="$typeOptionsArray"
                        />
                    </td>
                    <td>
                        <x-toggle-state 
                            :table="'attributes'"
                            :model="$attribute"
                        />
                    </td>
                    <td>
                        <x-remove-button 
                            :table="'attributes'"
                            :model="$attribute"
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
                <td>
                    <x-dropdown-input 
                        :column="'new_type'"
                        :model="null"
                        :options="$typeOptionsArray"
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