<?php

namespace App\Http\Controllers;

use Auth;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $statuses = Status::all();
        return view('status.index', ['statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $status = new Status();
        return view('status.create', ['status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
        ]);
        $status = new Status();
        $status->fill($data);
        if (!$status->save()) {
            flash(__('status.savingFailed'))->success()->important();
            return redirect()->route('status.index');
        }
        flash(__('status.store'))->success()->important();
        return redirect()->route('status.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\View\View
     */
    public function edit(Status $status)
    {
        return view('status.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Status $status)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
        ]);
        $status->fill($request->all());
        if (!$status->save()) {
            flash(__('status.updatingFailed'))->error()->important();
            return redirect()->route('status.index');
        }
        flash(__('status.update'))->important();
        return redirect()->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Status $status)
    {
        if ($status->tasks()->exists()) {
            flash(__('status.rejected'))->error()->important();
            return redirect()->route('status.index');
        }
        $tasks = $status->tasks;
        foreach ($tasks as $task) {
            $task->status()->dissociate();
            $task->save();
        }
        if (!$status->delete()) {
            flash(__('status.deletingFailed'))->error()->important();
            return redirect()->route('status.index');
        }
        flash(__('status.destroy'))->error()->important();
        return redirect()->route('status.index');
    }
}
