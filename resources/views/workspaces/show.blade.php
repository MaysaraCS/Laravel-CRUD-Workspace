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
        <div class="mb-3 mt-1 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0">{{ $workspace->name }}</h6>
                <small class="text-muted">Workspace Tasks</small>
            </div>
            <a href="{{ route('tasks.addTask', $workspace->id) }}" class="btn btn-primary btn-sm">Add Task</a>
        </div>
      <h6 class="border-bottom pb-2 mb-0">Tasks</h6>

      @if($tasks->count() > 0)
        @foreach($tasks as $task)
          <div class="d-flex text-body-secondary pt-3">
            @if($task->status === 'completed')
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                   viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="icon icon-tabler icons-tabler-outline icon-tabler-check-circle text-success">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                <path d="M9 12l2 2l4 -4" />
              </svg>
            @else
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                   viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                   class="icon icon-tabler icons-tabler-outline icon-tabler-circle text-warning">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
              </svg>
            @endif

            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
              <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">
                  {{ $task->title }}
                  @if($task->status === 'completed')
                    <small class="text-success">(Completed {{ $task->updated_at->diffForHumans() }})</small>
                  @else
                    <small class="text-muted">({{ \Carbon\Carbon::now()->diffForHumans($task->deadline, true) }} remaining)</small>
                  @endif
                </strong>
                <div class="d-flex gap-2">
                  @if($task->status !== 'completed')
                    <a href="{{ route('tasks.updateTaskStatus', $task->id) }}" class="btn btn-success btn-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           viewBox="0 0 24 24" fill="none" stroke="currentColor"
                           stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                           class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10" />
                      </svg>
                    </a>
                  @endif

                  <a href="{{ route('tasks.deleteTask', $task->id) }}" class="btn btn-danger btn-sm">
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
                  </a>
                </div>
              </div>
              <span class="d-block">{{ $task->description }}</span>
            </div>
          </div>
        @endforeach
        <div class="mt-3">
          {{ $tasks->links() }}
        </div>
      @else
        <p class="text-muted">No tasks yet.</a>.</p>
      @endif

    </div>
  </div>
</main>
@endsection
