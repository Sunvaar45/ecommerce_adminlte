@props(['table' => null, 'model' => null])

<a href="{{ route('delete', ['table' => $table, 'id' => $model->id]) }}" class="btn btn-sm btn-danger">
    <i class="fas fa-trash"></i>
</a>