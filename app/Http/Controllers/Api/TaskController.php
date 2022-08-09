<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;

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
        return (new Response($tasks, 200 , []));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $user_id = auth()->user()->id;
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->responsible = $request->responsible;
        $task->user_id = $user_id;
        $ret = $task->save();
        return (new Response($ret ? "Creado": "Error al crear",$ret ? 201 : 422 , []));
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
        $task = Task::findOrFail($id);
        return (new Response($task , $task ? 200:404 , []));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($request->id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->responsible = $request->responsible;
        $ret = $task->save();
        return (new Response($ret ? "Actualizado": "Error al actualizar",$ret ? 201 : 422 , []));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $task = Task::destroy($request->id);
        return (new Response($task ? 'Eliminado.': 'Error al eliminar', $task ? 200:404 , []));
    }
}
