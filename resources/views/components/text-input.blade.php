<input type="text"
    name="{{ isset($namePrefix) ? $namePrefix . '[' . $column . ']' : $column }}"
    value="{{ old($column, $model->$column ?? '') }}"
    class="form-control"
    @if(isset($required) && $required) required @endif
    >