<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\TaskStatus;
use Auth; 

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects;

        return view('projects.index')->with('projects', $projects);
    }

    public function create()
    {
       return view('projects.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        Project::create([
            'title' => $request->title,
            'user_id'=> Auth::user()->id,
        ]);

        return redirect()->route('projects.index')->with('success','Project created successfully.');
    }

    public function show(Project $project)
    {
        $this->authorize('show', $project);

        $task_statuses = TaskStatus::all()->pluck('title', 'id');

        return view('projects.show')->with([
            'project' => $project,
            'tasks' => $project->tasks,
            'task_statuses' => $task_statuses,
        ]);
    }

    public function edit(Project $project)
    {
        $this->authorize('edit', $project);

        return view('projects.edit')->with('project', $project);
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $this->validate($request, [
            'title' => 'required',
        ]);

        $project->update(['title' => $request->title]);

        return redirect()->route('projects.index')->with('success','Project updated successfully');
    }

    public function destroy(Project $project)
    {
       $this->authorize('delete', $project);
       
       $project->delete();

       return redirect()->route('projects.index')
                       ->with('success','Project deleted successfully');
    }
}
