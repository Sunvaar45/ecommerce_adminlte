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
                <th>Sil / Ekle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $i => $category)
                <tr>
                    <td>
                        <x-id-input 
                            :namePrefix="'categories[' . $i . ']'"
                            :model="$category"
                        />
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
                        <x-checkbox-input
                            :namePrefix="'categories[' . $i . ']'"
                            :column="'status'"
                            :model="$category"
                        />
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
            <tr>
                <form method="POST" action="{{ route('categories.add') }}">
                    @csrf
                    <td>Yeni</td>
                    <td>
                        <input type="text" name="name" class="form-control" required>
                    </td>
                    <td>
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1" unchecked>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>
                        </button>
                    </td>
                </form>
            </tr>
        </tbody>

    </table>

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