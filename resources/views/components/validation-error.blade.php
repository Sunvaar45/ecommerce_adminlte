@props(['column' => null])

@error($column)
    <div class="text-danger">{{ $message }}</div>
@enderror