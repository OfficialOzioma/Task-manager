<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Auth;

class TaskServices
{
    protected $response;

    protected $user;

    public function __construct()
    {
        $this->response = new ResponseService;

        $this->user = User::find(Auth::user()->id);

        if (!$this->user) {
            return $this->response->sendError('Please Login');
        }
    }

    public function createTask(array $data)
    {
        $task = $this->user->task()->create([
            "unique_id" => Str::uuid(),
            "user_id" => Auth::user()->id,
            "title" => $data['title'],
            "category_id" =>  $data['category_id'],
            "description" =>  $data['description'],
            "due_date" =>  $data['due_date'],
            "status" =>  'Pending',
        ]);

        if ($task) {
            return $this->response->sendResponse($task, 'Task created successfully.');
        }

        return $this->response->sendError('Can not create Task, Try again');
    }

    public function updateTask(array $data)
    {
        $findTaskByUniqueId = $this->user->task()->whereUniqueId($data['unique_id'])->first();

        if (!$findTaskByUniqueId) {
            return $this->response->sendError('Task Does not exit');
        }

        $updateTask =  $findTaskByUniqueId->update($data);

        if ($updateTask) {
            return $this->response->sendResponse($findTaskByUniqueId, 'Task created successfully.');
        }
    }

    public function deleteTask(array $data)
    {

        $findTaskByUniqueId = $this->user->task()->whereUniqueId($data['unique_id'])->first();

        if (!$findTaskByUniqueId) {
            return $this->response->sendError('Task Does not exit');
        }

        $deleteTask =  $findTaskByUniqueId->delete($data['unique_id']);

        if ($deleteTask) {
            return $this->response->sendResponse($findTaskByUniqueId, 'Task deleted successfully.');
        }
    }
}