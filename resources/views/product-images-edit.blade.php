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
            @foreach ($productImages as $i => $productImage)
                @php
                    $namePrefixBracket = 'productImages[' . $i . ']';
                    $namePrefixDot = 'productImages.' . $i . '.';
                @endphp
                <tr>
                    <td> {{-- ID --}}
                        <x-id-input 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :model="$productImage"
                        />
                    </td>
                    <td> {{-- ait olduğu ürün --}}
                        <x-dropdown-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :model="$productImage"
                            :column="'product_id'"
                            :options="$productsArray"
                        />
                    </td>
                    <td> {{-- görsel --}}
                        <x-image-upload 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :model="$productImage"
                            :column="'image_url'"
                            :imageDir="'images/products/'"
                            :maxWidth="'100px'"
                        />

                        <label for="{{ $namePrefixDot . 'image_alt' }}" style="margin-top: 10px;">Alternatif Metin</label>
                        <x-text-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'image_alt'"
                            :model="$productImage"
                        />
                    </td>
                    <td> {{-- status --}}
                        <x-toggle-state
                            :table="'product_images'"
                            :model="$productImage"
                        />
                    </td>
                    <td> {{-- sil --}}
                        <x-remove-button
                            :table="'product_images'" 
                            :model="$productImage" 
                        />
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>Yeni</td>
                <td> {{-- ait olduğu ürün --}}
                    <x-dropdown-input 
                        :column="'new_product_id'"
                        :model="null"
                        :options="$productsArray"
                    />
                </td>
                <td> {{-- görsel --}}
                    <x-image-upload 
                        :column="'new_image_url'"
                        :model="null"
                        :maxWidth="'100px'"
                    />

                    <label for="new_image_alt" style="margin-top: 10px;">Alternatif Metin</label>
                    <x-text-input
                        :column="'new_image_alt'"
                        :model="null"
                    />
                </td>
                <td> {{-- order --}}
                    <x-integer-input
                        :column="'new_sort_order'"
                        :model="null"
                    />
                </td>
                <td> {{-- is main --}}

                </td>
                <td><strong>Pasif</strong></td>
                <td> {{-- ekle --}}
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