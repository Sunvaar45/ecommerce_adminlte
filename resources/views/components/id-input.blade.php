<input type="hidden"
    name="{{ isset($namePrefix) ? $namePrefix . '[id]' : 'id' }}"
    value="{{ old('id', $model->id) }}">
{{ $model->id }}