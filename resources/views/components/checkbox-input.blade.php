<input type="hidden"
    name="{{ isset($namePrefix) ? $namePrefix . '['. $column .']' : $column }}"
    value="0">
    
<input type="checkbox"
    name="{{ isset($namePrefix) ? $namePrefix . '['. $column .']' : $column }}"
    value="1" {{ $model->$column ?? false ? 'checked' : '' }}>