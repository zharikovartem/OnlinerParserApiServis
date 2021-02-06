<?php

namespace App\Http\Controllers;

use App\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            "Tasks"=> TaskList::where('user_id', $request->get("user")->id)
            ->get()
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTask = new TaskList;
        $newTask->name = $request->get("name");
        $newTask->user_id = $request->get("user_id");

        $newTask->parent_id = $request->get("parent_id");
        $newTask->descriptions = $request->get("descriptions");

        $newTask->time_to_complete = $request->get("time_to_complete");
        
        // $newTask->date = now();
        $newTask->save();

        return self::index($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function show(TaskList $taskList)
    {
        return $taskList;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskList $taskList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskList $taskList)
    {
        $fields = $request->all();
        foreach ($fields as $field => $value) {
            if (isset($taskList[$field])) { 
                $taskList[$field] = $value;
            } else {
                $message[$field] = 'do not exist';
            }
        }

        if (isset($taskList)) {
            $taskList->save();
        }
        
        if (!isset($message)) {
            return response()->json([
                $taskList,
            ], 200);
        } else {
            return response()->json(['error'=>true, 'message'=>$message, 'taskList'=>$taskList], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TaskList $taskList)
    
    {
        $hz = $taskList-> delete();

        // $request = new Request;
        // $request->request->add([ 'date' => $task['date'] ]);

        return self::index($request);
        // return response()->json(['deletedTask'=>$taskList], 200);
    }
}
