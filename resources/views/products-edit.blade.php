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
            @foreach ($products as $i => $product)
                <tr>
                    <td>
                        <x-id-input 
                            :namePrefix="'products[' . $i . ']'"
                            :model="$product"
                        />
                    </td>
                    <td>
                        <x-text-input 
                            :namePrefix="'products[' . $i . ']'"
                            :column="'name'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td>
                        <x-text-input 
                            :namePrefix="'products[' . $i . ']'"
                            :column="'description'"
                            :model="$product"
                            :required="false"
                        />
                    </td>
                    <td>
                        <x-price-input
                            :namePrefix="'products[' . $i . ']'"
                            :column="'price'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td>
                        <x-price-input
                            :namePrefix="'products[' . $i . ']'"
                            :column="'discount_price'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-update-buttons />
</form>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

@stop