@extends('adminlte::page')

@section('title', 'Ürün Özelliklerini Düzenle')

@section('content_header')
    <h1>Ürün Özelliklerini Düzenle</h1>
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
            @foreach ($values as $i => $value)
                @php
                    $namePrefixBracket = 'values[' . $i . ']';
                    $namePrefixDot = 'values.' . $i . '.';
                @endphp
                <tr>
                    <x-id-input 
                        :namePrefixBracket="$namePrefixBracket"
                        :namePrefixDot="$namePrefixDot"
                        :model="$value"
                    />
                    <td> {{-- product ID --}}
                        <x-dropdown-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'product_id'"
                            :model="$value"
                            :options="$productsArray"
                        />
                    </td>
                    <td> {{-- attribute ID --}}
                        <x-dropdown-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'attribute_id'"
                            :model="$value"
                            :options="$attributesArray"
                        />
                    </td>
                    <td> {{-- value --}}
                        
                    </td>
                    <td> {{-- order --}}
                        <x-integer-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'sort_order'"
                            :model="$value"
                        />
                    </td>
                    <td> {{-- status --}}
                        <x-toggle-state 
                            :table="'product_attribute_values'"
                            :model="$value"
                        />
                    </td>
                    <td> {{-- delete --}}
                        <x-remove-button
                            :table="'product_attribute_values'"
                            :model="$value"
                        />
                    </td>
                </tr>
            @endforeach
            <tr>
                <td> {{-- product id --}}
                    <x-dropdown-input
                        :column="'new_product_id'"
                        :model="null"
                        :options="$productsArray"
                    />
                </td>
                <td> {{-- attribute id --}}
                    <x-dropdown-input
                        :column="'new_attribute_id'"
                        :model="null"
                        :options="$attributesArray"
                    />
                </td>
                <td> {{-- value --}}

                </td>
                <td> {{-- order --}}
                    <x-integer-input
                        :column="'new_sort_order'"
                        :model="null"
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