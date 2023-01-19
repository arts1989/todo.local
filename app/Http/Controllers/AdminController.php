<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use Auth; 

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function tasks(Request $request)
    {
        $tasks = Task::all();

        return view('admin.tasks')->with([
            'tasks' => $tasks,
        ]);
    }

    public function users(Request $request)
    {
        $users = User::where('id', '!=' , Auth::user()->id)->get();

        return view('admin.users')->with([
            'users' => $users,
        ]);
    }

    public function destroy(User $user)
    {
       $user->delete();

       return redirect('/admin/users');
    }
}