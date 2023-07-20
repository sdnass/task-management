@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Show Task ID: {{$task->id}} Details
                    <a href="/tasks" class="btn btn-danger float-end">x</a>
                </div>
                <div class="card-body">
                    <form action="/tasks" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col">
                                <label>Task Name</label>
                                <input type="text" name="taskname" id="taskname" class="form-control" value="{{$task->taskname}}" readonly>
                            </div>

                            <div class="col">
                                <label>Status</label>
                                <input type="text" name="status" id="status" class="form-control" value="{{$task->status}}" readonly>
                            </div>
                            <a href="/tasks/{{$task->id}}/edit" class="btn btn-primary">Edit Task</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
