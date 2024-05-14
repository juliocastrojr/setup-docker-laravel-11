<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = new Task();
        return response()->json($tasks->with(['user', 'status'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            Task::create($request->all());
            
            return response()->json([
                "success" => true,
                "message" => "Tarefa criada com sucesso!"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => []
            ], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $task = Task::find($id);
            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, int $id)
    {
        try {
            Task::find($id)->update($request->all());
            return response()->json("Tarefa atualizada com sucesso!");
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ],$e->getCode());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            
            Task::findOrFail($id)->delete();

            return response()->json([
                "success" => true,
                "message" => "Tarefa excluida com sucesso!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], $e->getCode());
        }
    }
}
