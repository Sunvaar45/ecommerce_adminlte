@props(['namePrefixBracket' => null, 'namePrefixDot' => null, 'column' => null, 'model' => null, 'required' => false])

<input type="number"
    @if (isset($namePrefixBracket) && isset($namePrefixDot))
        name="{{ $namePrefixBracket . '[' . $column . ']' }}"
        value="{{ old($namePrefixDot . $column, $model->$column ?? 0) }}"
    @else
        name="{{ $column }}"
        value="{{ old($column, $model->$column ?? 0) }}"
    @endif

    class="form-control"
    min="0"
    step="1"
    >

@if (isset($namePrefixDot))
    <x-validation-error :column="$namePrefixDot . $column" />
@else
    <x-validation-error :column="$column" />
@endif