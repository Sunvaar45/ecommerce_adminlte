@extends('adminlte::page')

@section('title', 'Ürün Düzenle')

@section('content_header')
<h1>"{{ $product->name }}" Ürünü Açıklaması</h1>
@stop

@section('content')

<x-success-alert />

<form method="POST" action="{{ route('products-description.update', $product->id) }}">
    @csrf
    <div>
        <textarea id="content-editor" name="description">{{ $product->description }}</textarea>
    </div>

    <x-update-buttons />
</form>

@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#content-editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@stop