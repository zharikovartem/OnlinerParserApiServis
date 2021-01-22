<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->get('date');

        $tasks = Task::where('date', $date)
                    ->get();

        return response()->json([
            "Tasks"=> $tasks,
            // "orgin"=> isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : 'NO HTTP_ORIGIN'
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
        $newTask = new Task;
        $newTask->name = $request->get("taskName");
        $newTask->user_id = $request->get("user_id");
        $newTask->time = $request->get("taskTime");
        $newTask->descriptions = $request->get("description");
        $newTask->date = $request->get("date");
        $newTask->save();

        return self::index($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $fields = $request->all();
        foreach ($fields as $field => $value) {
            if (isset($task[$field])) { 
                $task[$field] = $value;
            } else {
                $message[$field] = 'do not exist';
            }
        }
        $task->save();
        if (!isset($message)) {
            return response()->json([
                $task,
            ], 200);
        } else {
            return response()->json(['error'=>true, 'message'=>$message], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    /**
     * View interval of tasks
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTasksPart(Request $request)
    {
        $start_time = '00:00:00';
        if ( $request->get("start_time") !== null ) {
            $start_time = $request->get("start_time");
        }
        $end_time = '23:59:59';
        if ( $request->get("end_time") !== null ) {
            $end_time = $request->get("end_time");
        }

        $tasks = Task::where('date', '>=', $request->get("start_date"))
                    ->where('date', '<=', $request->get("end_date"))
                    ->where('time', '>=', $start_time)
                    ->where('time', '<=', $end_time)
                    ->orderBy('time', 'asc')
                    ->orderBy('date', 'asc')
                    ->get();

        return response()->json([
            "Tasks"=> $tasks
            ], 200);
    }
}
