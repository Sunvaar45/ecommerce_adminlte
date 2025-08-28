@props(['namePrefixBracket' => null, 'namePrefixDot' => null, 'column' => null, 'model' => null, 'options' => []])

<select
    @if (isset($namePrefixBracket) && isset($namePrefixDot))
        name="{{ $namePrefixBracket . '[' . $column . ']' }}"
    @else
        name="{{ $column }}"
    @endif
    class="form-control"
>
    <option value="">Seçiniz</option>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}"
            @if (isset($namePrefixBracket) && isset($namePrefixDot))
                {{ old($namePrefixDot . $column, $model->$column ?? '') == $value ? 'selected' : '' }}
            @else
                {{ old($column, $model->$column ?? '') == $value ? 'selected' : '' }}
            @endif
        >
            {{ $label }}
        </option>
    @endforeach
</select>