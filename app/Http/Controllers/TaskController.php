<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $service;
    protected $status;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\TaskService $service
     */
    public function __construct(TaskService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->status = config('status.task_status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->service->list();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->status;
        return view('tasks.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $this->service->store($request->except('_token'));

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task|integer $task
     * @return \Illuminate\Http\Response
     */
    public function show($task)
    {
        $task = $this->service->find($task);
        dd($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task|integer $task
     * @return \Illuminate\Http\Response
     */
    public function edit($task)
    {
        $task = $this->service->find($task);
        $statuses = $this->status;

        return view('tasks.edit', compact('task', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest $request
     * @param  \App\Models\Task|integer $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $task)
    {
        $this->service->update($task, $request->except('_token'));

        return redirect("/tasks/{$task}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect("/tasks");
    }
}
