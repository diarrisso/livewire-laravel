@extends('layouts.app')

@section('content')
    @livewire('todo-list')
@endsection
@push('scripts')
    <script>
        Livewire.on('taskCreated', () => {
            Livewire.emit('refreshTasks');
        });
    </script>
@endpush
