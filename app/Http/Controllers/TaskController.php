<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('users')->get();

        return view('task/list', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')->get();
        $priorities = DB::table('priorities')->get();
        $states = DB::table('states')->get();

        return view('task/edit', [
            'users' => $users,
            'priorities' => $priorities,
            'states' => $states,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->due_date = $request->due_date;
        $task->description = $request->description;
        $task->priority_id = $request->priority_id;
        $task->state_id = 1;
        //$task->assigned_to = $request->assigned_to;
        $task->created_by = Auth::user()->id;

        $task->save();

        $users = User::find($request->assigned_to);
        $task->users()->attach($users);

        return redirect()->route('tasks.show', ['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $users = DB::table('users')->get();
        $priorities = DB::table('priorities')->get();
        $states = DB::table('states')->get();

        $assignedUsers = $task->users()->get();

        $assigned_to = '';
        foreach ($assignedUsers as $assignedUser) {
            $assigned_to .= $assignedUser->name.', ';
        }
        $task->assigned_to = $assigned_to;

        return view('task/detail', [
            'task' => $task,
            'users' => $users,
            'priorities' => $priorities,
            'states' => $states,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $users = DB::table('users')->get();
        $priorities = DB::table('priorities')->get();
        $states = DB::table('states')->get();

        $assignedUsers = $task->users()->get();

        $assigned_to = '';
        foreach ($assignedUsers as $assignedUser) {
            $assigned_to .= $assignedUser->id.', ';
        }
        $task->assigned_to = $assigned_to;

        return view('task/edit', [
            'task' => $task,
            'users' => $users,
            'priorities' => $priorities,
            'states' => $states,
        ]);
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
        $task = Task::find($id);

        $task->name = $request->name;
        $task->due_date = $request->due_date;
        $task->description = $request->description;
        $task->priority_id = $request->priority_id;
        $task->state_id = $request->state_id;

        $task->save();

        $users = User::find($request->assigned_to);
        $task->users()->detach();
        $task->users()->attach($users);

        return redirect()->route('tasks.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        var_dump($id);
        $task = Task::find($id);

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
