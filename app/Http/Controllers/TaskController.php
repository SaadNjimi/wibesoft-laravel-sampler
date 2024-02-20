<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Notifications\TaskCreated; 

class TaskController extends Controller
{
    // Create a new task
    public function store(Request $request)
    {
        $request->validate([
            'task_time' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'admin_id' => 'nullable|exists:administrators,id'
        ]);

        $task = Task::create($request->all());

        // Send email notification
        $administrators = \App\Administrator::all(); 
        foreach ($administrators as $admin) {
            $admin->notify(new TaskCreated($task));
        }

        return response()->json($task, 201);
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_time' => 'sometimes|required|date',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'admin_id' => 'nullable|exists:administrators,id'
        ]);

        $task->update($request->all());

        return response()->json($task, 200);
    }

    // Soft delete a task
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(null, 204);
    }
}
