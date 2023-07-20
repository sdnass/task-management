<form method="POST" action="/tasks/{{$task->id}}" enctype="multipart/form-data">
    @csrf
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger">Archive</button>
</form>
