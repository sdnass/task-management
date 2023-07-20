@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="float-start">List of Tasks</h4>
            <a href="/tasks/create" class="btn btn-primary btn-md float-end">{{ __('New Task') }}</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th>
                                <a href="/tasks/{{$task->id}}">{{ $task->id }}</a>
                            </th>
                            <td>{{ $task->taskname }}</td>
                            @if ($task->status == 'Todo')
                            <td>
                                <span class="badge text-bg-secondary">
                                    {{ $task->status }}
                                </span>
                            </td>
                            @elseif ($task->status == 'In Progress')
                                <td>
                                    <span class="badge text-bg-warning">
                                        {{ $task->status }}
                                    </span>
                                </td>
                            @elseif ($task->status == 'Completed')
                                <td>
                                    <span class="badge text-bg-success">
                                        {{ $task->status }}
                                    </span>
                                </td>
                            @endif

                            <td>@include('tasks.partials.delete_form')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $tasks->links() !!}
    </div>
</div>
@endsection
