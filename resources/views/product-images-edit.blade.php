@extends('adminlte::page')

@section('title', 'Ürün Görsellerini Düzenle')

@section('content_header')
<h1>Ürün Görsellerini Düzenle</h1>
@stop

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('product-images.update') }}">
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
            @foreach ($categories as $i => $category)
                @php
                    $namePrefixBracket = 'categories[' . $i . ']';
                    $namePrefixDot = 'categories.' . $i . '.';
                @endphp
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>
                        <x-checkbox-input :namePrefixBracket="$namePrefixBracket" :namePrefixDot="$namePrefixDot"
                            :column="'status'" :model="$category" />
                    </td>
                    <td>
                        <x-remove-button :model="$category" />
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>Yeni</td>
                <td>
                    <x-text-input :column="'new_name'" :model="null" :required="false" />
                </td>
                <td>
                    <x-checkbox-input :column="'new_status'" :model="null" />
                </td>
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
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
<link rel="stylesheet" href="/css/table_style.css">
@stop

@section('js')
<script src="{{ asset('js/hideAlerts.js') }}"></script>

@stop