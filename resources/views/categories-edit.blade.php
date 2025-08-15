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

    <table class="table table-bordered" id="categories-table">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
                <th>Sil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $i => $category)
                <tr>
                    <td>
                        <input type="hidden"
                            name="categories[{{ $i }}][id]"
                            value="{{ $category->id }}">
                            {{ $category->id }}
                    </td>
                    <td>
                        <x-text-input 
                            :namePrefix="'categories[' . $i . ']'"
                            :column="'name'"
                            :model="$category"
                            :required="true"
                        />
                    </td>
                    <td>
                        <input type="hidden"
                            name="categories[{{ $i }}][status]"
                            value="0">
                        <input type="checkbox"
                            name="categories[{{ $i }}][status]"
                            value="1" {{ $category->status ? 'checked' : '' }}>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('categories.delete') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>                     
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="mb-3">
        <button type="button" class="btn btn-success" id="add-category-btn">Ekle</button>
    </div>
    <x-submit-buttons />

</form>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="{{ asset('js/hideAlerts.js') }}"></script>

@stop