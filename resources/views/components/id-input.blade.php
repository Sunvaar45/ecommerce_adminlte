@props(['namePrefixBracket' => null, 'namePrefixDot' => null, 'model' => null])

<input type="hidden"
    @if (isset($namePrefixBracket) && isset($namePrefixDot))
        name="{{ $namePrefixBracket . '[id]' }}"
        value="{{ old($namePrefixDot . 'id', $model->id) }}"
    @else
        name="id"
        value="{{ old('id', $model->id) }}"
    @endif
>
{{ $model->id }}