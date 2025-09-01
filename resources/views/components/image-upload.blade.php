@props(['namePrefixBracket' => null, 'namePrefixDot' => null, 'column' => null, 'model' => null, 'imageDir' => null, 'maxWidth' => null])

@php
    use Illuminate\Support\Facades\Storage;
    /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
@endphp

{{-- display image --}}
@if ($model != null)
    @php
        $disk = env('MAIN_STORAGE_DISK', 'public');
        $storage = Storage::disk($disk);
        $url = $storage->url($imageDir . '/' . $model->image_url);
    @endphp

    <img src="{{ $url }}"
        alt="Mevcut Görsel"
        style="max-width: {{ $maxWidth }}; height: auto;"
        class="img-thumbnail">
@endif

{{-- file input --}}
<input type="file"
    @if (isset($namePrefixBracket) && isset($namePrefixDot))
        name="{{ $namePrefixBracket . '[' . $column . ']' }}"
    @else
        name="{{ $column }}"
    @endif
    class="form-control">

{{-- error handling --}}
@if (isset($namePrefixBracket) && isset($namePrefixDot))
    <x-validation-error :column="$namePrefixDot . $column" />
@else
    <x-validation-error :column="$column" />
@endif