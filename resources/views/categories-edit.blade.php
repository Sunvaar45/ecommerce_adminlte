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
                    <th>ID</th>
                    <th>İsim</th>
                    <th>Aktif</th>
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
                            <input type="text"
                                name="categories[{{ $i }}][name]"
                                value="{{ $category->name }}"
                                class="form-control" required>
                        </td>
                        <td>
                            <input type="hidden"
                                name="categories[{{ $i }}][status]"
                                value="0">
                            <input type="checkbox"
                                name="categories[{{ $i }}][status]"
                                value="1" {{ $category->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                @endforeach
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

@stop