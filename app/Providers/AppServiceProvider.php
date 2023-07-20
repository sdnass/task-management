<?php

namespace App\Providers;

use App\Services\TaskService;
use App\Services\TaskServiceInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::macro('softDeletes', function () {
            Route::get('tasks/trashed', 'TaskController@trashed')->name('tasks.trashed');
            Route::delete('tasks/{task}/delete', 'TaskController@delete')->name('tasks.delete');
            Route::patch('tasks/{task}/restore', 'TaskController@restore')->name('tasks.restore');
        });
    }
}
