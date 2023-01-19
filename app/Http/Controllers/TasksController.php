<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;
use App\TaskStatus;
use Auth; 

class TasksController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'project_id' => 'required|integer',
            'status_id' => 'required|integer',
        ]);

        $project = Project::find($request->project_id);

        $this->authorize('show', $project);

        Task::create([
            'title' => $request->title,
            'user_id'=> Auth::user()->id,
            'project_id' => $project->id,
            'status_id' => $request->status_id,
        ]);

        return redirect()->route('projects.show', ['id' => $project->id]);
    }

    public function edit(Task $task)
    {
        $this->authorize('edit', $task);

        $task_statuses = TaskStatus::all()->pluck('title', 'id');

        return view('tasks.edit')->with([
            'task' => $task,
            'task_statuses' => $task_statuses,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $this->validate($request, [
            'title' => 'required',
            'status_id' => 'required|integer',
        ]);

        $task->update([
            'title' => $request->title,
            'status_id' => $request->status_id,
        ]);

        return redirect()->route('projects.show', ['id' => $task->project->id]);
    }

    public function destroy(Task $task)
    {
       $this->authorize('delete', $task);
       
       $task->delete();

       return redirect()->route('projects.show', ['id' => $task->project->id]);
    }
}