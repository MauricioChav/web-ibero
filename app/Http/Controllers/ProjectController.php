<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Colección de Proyectos
        $projects = Project::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->get();
        
        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description ,
            'final_date' => $request->final_date ,
            'hex' => $request->hex
        ]);
        
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('show')->with('project', $project);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        
        $project->update([
            'name' => $request->name,
            'description' => $request->description ,
            'final_date' => $request->final_date ,
            'hex' => $request
        ]);
        
        
        if($request->origin == 0){
            //Regresar a detalle de tarea
            return redirect()->back();
        }else{
            //Regresar si esta desde la pantalla editar
        return redirect()->route('projects.show', $project->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        
        return redirect()->route('projects.index');
    }
}
