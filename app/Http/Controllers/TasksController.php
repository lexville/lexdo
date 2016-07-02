<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::personalize()->orderBy('id', 'desc')->paginate(6);;
        return view('tasks.index',['tasks' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required|max:50',
            'description' => 'required|max:1000',
        ]);
        $task = new Task();
        $task->description = $request->input('description');
        $task->task = $request->input('task');
        // $task->user_id = auth()->user()->id;
        // dd($task);

        $request->user()->tasks()->save($task);
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'task' => 'required|max:50',
            'description' => 'required|max:1000',
        ]);

        $updateTask = Task::findOrFail($id);
        $updateTask->task = $request['task'];
        $updateTask->description = $request['description'];
        $updateTask->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->findById($id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Get video based on the id.
     *
     * @return video by id
     */
    private function findById($id)
    {
        return Task::findOrFail($id);
    }
}
