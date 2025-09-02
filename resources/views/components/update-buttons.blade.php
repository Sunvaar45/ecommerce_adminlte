@props(['submitLabel' => 'Güncelle', 'cancelLabel' => 'İptal', 'route' => 'home'])

<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
<a href="{{ route($route) }}" class="btn btn-secondary">{{ $cancelLabel }}</a>