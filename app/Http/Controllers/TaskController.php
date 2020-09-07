<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Task;
use App\Status;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()) {
            if(Auth::user()->hasVerifiedEmail()) {
                $users = User::all();
                $statuses = Status::all();
                return view('task.create', ['statuses' => $statuses, 'users' => $users]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $task = new Task();
                $task->name = $request->post('name');
                $task->description = $request->post('description');
                Status::find($request->post('status'))->tasks()->save($task);
                Auth::user()->createdBy()->save($task);
                User::find($request->post('asignee'))->assignedTo()->save($task);
                return redirect()->route('task.index');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $task = Task::find($id);
                $users = User::all();
                $statuses = Status::all();
                return view('task.edit', ['task' => $task, 'statuses' => $statuses, 'users' => $users]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $task = Task::find($id);
                $task->status()->dissociate();
                $task->assigner()->dissociate();
                $task->name = $request->post('name');
                $task->description = $request->post('description');
                Status::find($request->post('status'))->tasks()->save($task);
                User::find($request->post('asignee'))->assignedTo()->save($task);
                return redirect()->route('task.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $task = Task::find($id);
                $task->status()->dissociate();
                $task->creator()->dissociate();
                $task->assigner()->dissociate();
                $task->delete();
            }
        }
    }
}
