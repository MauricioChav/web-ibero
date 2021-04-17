<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 //LISTADO DE TAREAS
    public function index()
    {
		//Colección de tareas
		$tasks = Task::where('user_id', Auth::user()->id)->get();
        $projects = Project::where('user_id', Auth::user()->id)->get();
		
        return view('tasks.index')
        ->with('tasks', $tasks)
        ->with('projects', $projects);
    }
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 //FORMULARIO DE CRACIÓN
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//Modo Pro
        $task = Task::create([
            'user_id' => Auth::user()->id,
			'name' => $request->name,
			'description' => $request->description ,
			'due_date' => $request->due_date ,
            'project_id' => $request->project_id
		]);
		
		// Modo N00B
		/*
		$tarea = new Task;
		
		$tarea->name = $request->name;
		$tarea->description = $request->description;
		$tarea->due_date = $request->due_date;
		
		$tarea->save();
		*/
		
		return redirect()->back();
    }
/* Modelo/Lo que recibe*/
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
	 
	 //VISTA DE UNA SOLA TAREA
    public function show($id)
    {
		$task = Task::find($id);

        if(empty($task)){
            return redirect()->back();
        }else{
            return view('tasks.show')->with('task', $task);

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
	 
	 // ACTUALIZAR / EDITAR
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		//Modo Pro
		$task = Task::find($id);
		
        $task->update([
			'name' => $request->name,
			'description' => $request->description ,
			'due_date' => $request->due_date ,
			'status' => $request->status,
            'project_id' => $request->project_id
		]);
		
		
		//Modo Noob
		/*
        $task = Task::find($id);
		
		$task->name = $request->name;
		$task->description = $request->description;
		$task->due_date = $request->due_date;
		
		$task->save();
		*/
		
		if($request->origin == 0){
			//Regresar a detalle de tarea
			return redirect()->back();
		}else{
			//Regresar si esta desde la pantalla editar
		return redirect()->route('tareas.show', $task->id);
		}
		
		
		
		//return redirect()->route('tareas.show', $task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
	 
	 //BORRAR
    public function destroy($id)
    {
        $task = Task::find($id);
		$task->delete();
		
		return redirect()->route('tareas.index');
    }
}
