@php
    $dotName = null;
    if (isset($namePrefix)) {
        $dotName = str_replace(['[', ']'], ['.', ''], $namePrefix) . '.' . $column;
    }
    else {
        $dotName = $column;
    }
@endphp

<input type="text"
    name="{{ isset($namePrefix) ? $namePrefix . '[' . $column . ']' : $column }}"
    value="{{ old($dotName, $model->$column ?? '') }}"
    class="form-control"
    @if(isset($required) && $required) required @endif
    >