<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class TaskService implements TaskServiceInterface
{
    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository
     *
     * @param \App\Models\Task $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Task $model, Request $request)
    {
        $this->model = $model;
        $this->request  = $request;
    }

    /**
     * Define the validation rules for the model.
     *
     * @param  integer|null $id
     * @return array
     */
    public function rules($id = null)
    {
        return[
            'taskname' => 'required|max:255',
            'status' => 'required',
        ];
    }

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list()
    {
        $tasks = $this->model->get();

        $lists = $this->paginate($tasks);

        return $lists;
    }

    /**
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        return $this->model->firstOrCreate([
            'taskname' => $attributes['taskname'],
            'status' => $attributes['status'],
        ]);
    }

    /**
     * Retrieve model resource details.
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id):? Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update model resource.
     *
     * @param  integer $id
     * @param  array $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes)
    {
        $task = $this->find($id);

        $task->taskname = $attributes['taskname'];
        $task->status = $attributes['status'];

        return $task->save();
    }

    /**
     * Soft delete model resource.
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $task = $this->find($id);

        $task->delete();
    }

    /**
     * Modify default Model's pagination
     * to react to url parameters.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function paginate($items, $perPage = 20, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, ['path' => Paginator::resolveCurrentPage()]);
    }
}
