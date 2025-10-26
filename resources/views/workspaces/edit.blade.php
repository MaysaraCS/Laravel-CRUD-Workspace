@extends("layouts.default")

@section("content")
<div class="d-flex align-items-center">
    <div class="container card shadow-sm" style="margin-top:100px; max-width: 500px">
        <div class="fs-3 fw-bold text-center">Edit Workspace</div>
        <form class="p-3" method="POST" action="{{route("workspaces.update", $workspace->id)}}">
            @csrf
            @method('PUT')
            <div class="mb-3 mt-1">
                <label for="name" class="form-label">Workspace Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $workspace->name }}" required>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif
            <button class="btn btn-success rounded-pill" type="submit">Update Workspace</button>
            <a href="{{ route('home') }}" class="btn btn-secondary rounded-pill">Cancel</a>
        </form>
        </div>
    </div>
@endsection
