@props(['table', 'model', 'column' => 'status'])

{{-- TOGGLE STATE BUTTON --}}
<a href="{{ route('set-active-state', ['table' => $table, 'id' => $model->id]) }}"
    class="btn btn-sm {{ $model->$column ? 'btn-primary' : 'btn-secondary' }}">
    @if ($model->$column)
        <strong>Aktif</strong>
    @else
        <strong>Pasif</strong>
    @endif
</a>