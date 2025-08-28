@props(['submitLabel' => 'Güncelle', 'cancelLabel' => 'İptal'])

<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
<a href="/" class="btn btn-secondary">{{ $cancelLabel }}</a>