@extends("layouts.default")

@section('content')
<main class="flex-shrink-0 mt-5">
  <div class="container" style="max-width: 800px">

    @if(session()->has('success'))
      <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif

    @if(session()->has('error'))
      <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 mt-1">Welcome {{auth()->user()->username}}</div>
      <h6 class="border-bottom pb-2 mb-0">Your Workspaces</h6>

      @if($workspaces->count() > 0)
        @foreach($workspaces as $workspace)
          <div class="d-flex text-body-secondary pt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="icon icon-tabler icons-tabler-outline icon-tabler-folder">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
            </svg>

            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
              <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">
                  <a href="{{ route('workspaces.show', $workspace->id) }}" class="text-decoration-none">{{ $workspace->name }}</a>
                </strong>
                <div class="d-flex gap-2">
                  <a href="{{ route('workspaces.edit', $workspace->id) }}" class="btn btn-warning btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                      <path d="M16 5l3 3" />
                    </svg>
                  </a>

                  <form action="{{ route('workspaces.destroy', $workspace->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this workspace?')">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           viewBox="0 0 24 24" fill="none" stroke="currentColor"
                           stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                           class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <p class="text-muted">No workspaces yet. 
        </p>
      @endif

    </div>
  </div>
</main>
@endsection
