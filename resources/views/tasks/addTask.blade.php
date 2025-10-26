@extends("layouts.default")

@section("content")
<div class="d-flex align-items-center">
    <div class="container card shadow-sm" style="margin-top:100px; max-width: 500px">
        <div class="fs-3 fw-bold text-center">Add New Task to {{ $workspace->name }}</div>
        <form class="p-3" method="POST" action="{{route("tasks.addTask.post", $workspace->id)}}">
            @csrf
            <div class="mb-3 mt-1">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" name="title" class="form-control" id="title" required>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" name="deadline" id="deadline" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" id="description" required></textarea>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif
            <button class="btn btn-success rounded-pill" type="submit">Add Task</button>
            <a href="{{ route('workspaces.show', $workspace->id) }}" class="btn btn-secondary rounded-pill">Cancel</a>
        </form>
        </div>
    </div>
@endsection
