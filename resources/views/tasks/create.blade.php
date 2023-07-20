@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">New Task</div>
            <div class="card-body">
                <form action="/tasks" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col">
                            <label>Task Name</label>
                            <input type="text" name="taskname" id="taskname" class="form-control" required>
                        </div>

                        <div class="col">
                            <label>Status</label>
                            <select class="form-select" name="status" required>
                                <option value="">Select</option>
                                @foreach ($statuses as $status)
                                    <option value="{{$status}}">{{$status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
