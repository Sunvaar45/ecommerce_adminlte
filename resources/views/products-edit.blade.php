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
                @php
    $namePrefixBracket = 'products[' . $i . ']';
    $namePrefixDot = 'products.' . $i . '.';
                @endphp
                <tr>
                    <td>
                        <x-id-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :model="$product"
                        />
                    </td>
                    <td> {{-- isim --}}
                        <x-text-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'name'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- açıklama --}}
                        <x-text-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'description'"
                            :model="$product"
                            :required="false"
                        />
                    </td>
                    <td> {{-- fiyat --}}
                        <x-price-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'price'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- indirim aktif checkbox --}}
                        <x-checkbox-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'has_discount'"
                            :model="$product"
                        />
                    </td>
                    <td> {{-- indirimli fiyat --}}
                        <x-price-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'discount_price'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- stok miktarı --}}
                        <x-integer-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'stock'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- renk --}}
                        <x-text-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'color'"
                            :model="$product"
                            :required="false"
                        />
                    </td>
                    <td> {{-- görsel --}}
                        
                        {{-- display image --}}
                        <img src="{{ asset('storage/images/' . $product->id . '/' . $product->image_url) }}"
                            alt="{{ $product->name }}"
                            class="img-thumbnail">

                        {{-- file input --}}
                        <input type="file"
                            name="products[{{ $i }}][image]"
                            class="form-control">
                    </td>
                    <td> {{-- ait olduğu kategori --}}
                        <select name="products[{{ $i }}][category_id]" class="form-control" required>
                            <option value="">Kategori Seçiniz</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if ($product->category_id == $category->id) selected @endif>
                                    {{ $category->id . ' - ' . $category->name }}
                                </option>
                            @endforeach
                        </select>

                    </td>
                    <td> {{-- aktif durumu --}}
                        <x-checkbox-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'status'"
                            :model="$product"
                        />
                    </td>
                    <td> {{-- silme butonu --}}
                        <x-remove-button 
                            :model="$product"
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
<script src="{{ asset('js/hideAlerts.js') }}"></script>

@stop