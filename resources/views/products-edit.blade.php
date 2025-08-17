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
                    <td> {{-- isim --}}
                        <x-text-input 
                            :namePrefix="'products[' . $i . ']'"
                            :column="'name'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- açıklama --}}
                        <x-text-input 
                            :namePrefix="'products[' . $i . ']'"
                            :column="'description'"
                            :model="$product"
                            :required="false"
                        />
                    </td>
                    <td> {{-- fiyat --}}
                        <x-price-input
                            :namePrefix="'products[' . $i . ']'"
                            :column="'price'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- indirim aktif checkbox --}}
                        <x-checkbox-input
                            :namePrefix="'products[' . $i . ']'"
                            :column="'has_discount'"
                            :model="$product"
                        />
                    </td>
                    <td> {{-- indirimli fiyat --}}
                        <x-price-input
                            :namePrefix="'products[' . $i . ']'"
                            :column="'discount_price'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- stok miktarı --}}
                        <x-integer-input
                            :namePrefix="'products[' . $i . ']'"
                            :column="'stock'"
                            :model="$product"
                            :required="true"
                        />
                    </td>
                    <td> {{-- renk --}}
                        <x-text-input
                            :namePrefix="'products[' . $i . ']'"
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

                    </td>
                    <td> {{-- aktif durumu --}}
                        
                    </td>
                    <td> {{-- silme butonu --}}

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