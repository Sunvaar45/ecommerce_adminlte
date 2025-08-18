<input type="number"
    @if (isset($namePrefixBracket) && isset($namePrefixDot))
        name="{{ $namePrefixBracket . '[' . $column . ']' }}"
        value="{{ old($namePrefixDot . $column, $model->$column ?? '') }}"
    @else
        name="{{ $column }}"
        value="{{ old($column, $model->$column ?? '') }}"
    @endif
    class="form-control"
    step="0.01"
    min="0"
    @if(isset($required) && $required) required @endif
    >

@if (isset($namePrefixDot))
    <x-validation-error :column="$namePrefixDot . $column" />
@else
    <x-validation-error :column="$column" />
@endif