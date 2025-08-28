@props(['namePrefixBracket' => null, 'namePrefixDot' => null, 'column' => null, 'model' => null, 'required' => false])

{{-- TEXT INPUT --}}
<input type="text"
    @if (isset($namePrefixBracket) && isset($namePrefixDot))
        name="{{ $namePrefixBracket . '[' . $column . ']' }}"
        value="{{ old($namePrefixDot . $column, $model->$column ?? '') }}"
    @else
        name="{{ $column }}"
        value="{{ old($column, $model->$column ?? '') }}"
    @endif
    class="form-control"
    @if(isset($required) && $required) required @endif
    >

{{-- error handling --}}
@if (isset($namePrefixBracket) && isset($namePrefixDot)) 
    <x-validation-error :column="$namePrefixDot . $column" />
@else
    <x-validation-error :column="$column" />
@endif