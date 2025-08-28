@extends('adminlte::page')

@section('title', 'Ürün Düzenle')

@section('content_header')
<h1>Ürün Düzenle</h1>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('products.update') }}" enctype="multipart/form-data">
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
                        <x-image-upload
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'image_url'"
                            :model="$product"
                            :imageDir="'storage/images/products/'"
                            :maxWidth="'100px'"
                        />
                    </td>
                    <td> {{-- ait olduğu kategori --}}
                        <x-dropdown-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'category_id'"
                            :model="$product"
                            :options="$categoriesArray"
                        /> 
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
            <tr>
                <td>Yeni</td>
                <td> {{-- ürün adı --}}
                    <x-text-input 
                        :column="'new_name'"
                        :model="null"
                        :required="false"
                    />
                </td>
                <td> {{-- açıklama --}}
                    <x-text-input 
                        :column="'new_description'"
                        :model="null"
                        :required="false"
                    />
                </td>
                <td> {{-- fiyat --}}
                    <x-price-input
                        :column="'new_price'"
                        :model="null"
                        :required="false"
                    />
                </td>
                <td> {{-- indirim aktif --}}
                    <x-checkbox-input
                        :column="'new_has_discount'"
                        :model="null"
                    />
                </td>
                <td> {{-- indirimli fiyat --}}
                    <x-price-input
                        :column="'new_discount_price'"
                        :model="null"
                        :required="false"
                    />
                </td>
                <td> {{-- stok miktarı --}}
                    <x-integer-input
                        :column="'new_stock'"
                        :model="null"
                        :required="true"
                    />
                </td>
                <td> {{-- renk --}}
                    <x-text-input
                        :column="'new_color'"
                        :model="null"
                        :required="false"
                    />
                </td>
                <td> {{-- görsel --}}
                    <x-image-upload
                        :column="'new_image_url'"
                        :model="null"
                        :imageDir="'storage/images/products/'"
                        :maxWidth="'100px'"
                    />
                </td>
                <td> {{-- ait olduğu kategori --}}
                    <select name="new_category_id" class="form-control">
                        <option value="" selected>Kategori Seçiniz</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->id . ' - ' . $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('new_category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </td>
                <td> {{-- aktif durumu --}}
                    <x-checkbox-input
                        :column="'new_status'"
                        :model="null"
                    />
                </td>
                <td> {{-- ekleme butonu --}}
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