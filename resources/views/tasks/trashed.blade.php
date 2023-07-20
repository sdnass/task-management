@extends('layouts.app')


@section('content')
	<div class="container-lg">
		<div class="card">
			<div class="card-header">
				<h4>List of Deleted Users</h4>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#ID</th>
							<th scope="col">Task</th>
						</tr>
					</thead>
					<tbody>
			@foreach($tasks as $task)
						<tr>
							<th scope="row"><a href="/tasks/{{$task->id}}">{{ $task->id }} </a></th>
							<td>{{ $task->taskname }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		{!! $tasks->links() !!}
		</div>
	</div>
@endsection
