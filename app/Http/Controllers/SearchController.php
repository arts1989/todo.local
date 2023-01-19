<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\TaskStatus;
use Auth; 

class SearchController extends Controller
{
    public function index(Request $request)
    {
       
        $where = [];

        if(!is_null($request->title)) {
            $this->validate($request, ['title' => 'string']);
            $where[] = ['title', 'like', '%' . $request->title . '%'];
        }

        if(!is_null($request->status_id)) {
            $this->validate($request, ['status_id' => 'integer']);
            $where[] = ['status_id', $request->status_id]; 
        }

        $projects_id = Auth::user()->projects->pluck('id')->toArray();
        
        $tasks = Task::whereIn('project_id', $projects_id)
                    ->where($where)
                    ->get();

        $task_statuses = TaskStatus::all()->pluck('title', 'id');

        return view('search.index')->with([
            'task_statuses' => $task_statuses,
            'tasks' => $tasks,
        ]);
    }
}