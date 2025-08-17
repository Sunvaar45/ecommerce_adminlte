@php
$dotName = null;
if (isset($namePrefix)) {
    $dotName = str_replace(['[', ']'], ['.', ''], $namePrefix) . '.' . $column;
}
else {
    $dotName = $column;
}
@endphp

<input type="number"
    name="{{ isset($namePrefix) ? $namePrefix . '[' . $column . ']' : $column }}"
    value="{{ old($dotName, $model->$column ?? 0) }}"
    class="form-control"
    min="0"
    step="1"
    @if(isset($required) && $required) required @endif
    >

@error($dotName)
    <div class="text-danger">{{ $message }}</div>
@enderror