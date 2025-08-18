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
                        
                    </td>
                    <td> {{-- görsel --}}
                        <x-image-upload 
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :model="$productImage"
                            :column="'image_url'"
                            :imageDir="'storage/images/products/'"
                            :maxWidth="'100px'"
                        />
                    </td>
                    <td> {{-- görsel alternatif metin --}}
                        <x-text-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'image_alt'"
                            :model="$productImage"
                        />
                    </td>
                    <td> {{-- aktif checkbox --}}
                        <x-checkbox-input
                            :namePrefixBracket="$namePrefixBracket"
                            :namePrefixDot="$namePrefixDot"
                            :column="'status'"
                            :model="$productImage"
                        />
                    </td>
                    <td> {{-- sil --}}
                        <x-remove-button :model="$productImage" />
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>Yeni</td>
                <td> {{-- ait olduğu ürün --}}
                    
                </td>
                <td> {{-- görsel --}}
                    
                </td>
                <td> {{-- görsel alt metin --}}

                </td>
                <td> {{-- aktif checkbox --}}

                </td>
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