@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Edit Task ID: {{$task->id}}
                <a href="/tasks" class="btn btn-danger float-end">x</a>
            </div>
            <div class="card-body">
                <form action="/tasks/{{$task->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row g-3">
                        <div class="col">
                            <label>Task Name</label>
                            <input type="text" value="{{$task->taskname}}" name="taskname" id="taskname" class="form-control" required>
                        </div>

                        <div class="col">
                            <label>Status</label>
                            <select class="form-select" value="{{$task->status}}" name="status" required>
                                <option value="">Select</option>
                                @foreach ($statuses as $status)
                                    @if ($task->status == $status)
                                        <option value="{{$status}}" selected>{{$status}}</option>
                                    @else
                                        <option value="{{$status}}">{{$status}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
