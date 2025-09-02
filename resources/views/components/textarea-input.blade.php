@props(['namePrefixBracket' => null, 'namePrefixDot' => null, 'column' => null, 'model' => null, 'rows' => null, 'required' => false])

{{-- TEXTAREA INPUT --}}
<textarea
    @if (isset($namePrefixBracket) && isset($namePrefixDot))
        name="{{ $namePrefixBracket . '[' . $column . ']' }}"
        id="{{ $namePrefixDot . $column }}"
    @else
        name="{{ $column }}"
        id="{{ $column }}"
    @endif
    class="form-control"
    rows="{{ $rows ?? 4 }}"
    @if(isset($required) && $required) required @endif
>
@if (isset($namePrefixBracket) && isset($namePrefixDot))
{{ old($namePrefixDot . $column, $model->$column ?? '') }}
@else
{{ old($column, $model->$column ?? '') }}
@endif
</textarea>

{{-- error handling --}}
@if (isset($namePrefixBracket) && isset($namePrefixDot)) 
    <x-validation-error :column="$namePrefixDot . $column" />
@else
    <x-validation-error :column="$column" />
@endif