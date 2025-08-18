{{-- display image --}}
@if ($model != null)
    <img src="{{ asset($imageDir . $model->$column) }}"
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