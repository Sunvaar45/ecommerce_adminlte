@extends('adminlte::page')

@section('title', 'Ürün Özelliklerini Düzenle')

@section('content_header')
<h1>Ürün Özelliklerini Düzenle</h1>
@stop

@section('content')

<x-success-alert />
<x-info-alert />
<x-error-alert />

<form method="GET" action="{{ route('product-attribute-values.edit') }}" class="mb-3">
    <div class="form-inline">
        <label for="product_id" class="mr-2">Ürüne Göre Filtrele:</label>
        <select name="product_id" id="product_id" class="form-control mr-2" onchange="this.form.submit()">
            <option value="">-- Hepsi --</option>
            @foreach($productsArray as $productId => $productLabel)
                <option value="{{ $productId }}"
                    @if (isset($filteredProductId) && $filteredProductId == $productId)
                        selected
                    @endif
                >
                    {{ $productLabel }}
                </option>
            @endforeach
        </select>
        @if(request('product_id'))
            <a href="{{ route('product-attribute-values.edit') }}" class="btn btn-sm btn-outline-secondary">Sıfırla</a>
        @endif
    </div>
</form>

<form method="POST" action="{{ route('product-attribute-values.update') }}">
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
                    $attributeType = $value->attribute->type;
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
                        @if ($attributeType == 'text')
                            <x-text-input 
                                :namePrefixBracket="$namePrefixBracket"
                                :namePrefixDot="$namePrefixDot"
                                :column="'value'"
                                :model="$value"
                            />
                        @elseif ($attributeType == 'boolean')
                            <x-dropdown-input 
                                :namePrefixBracket="$namePrefixBracket"
                                :namePrefixDot="$namePrefixDot"
                                :column="'value'"
                                :model="$value"
                                :options="['Evet' => 'Evet', 'Hayır' => 'Hayır']"
                            />
                        @endif
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
                    Burası özellik türüne göre doldurulacak
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