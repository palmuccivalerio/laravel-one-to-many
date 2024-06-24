<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)

    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Genera lo slug automaticamente
        $data['slug'] = Str::slug($data['title']);

        // Crea il nuovo progetto
        $project = Project::create($data);

        return redirect()->route('admin.projects.show', ['project' => $project->slug])->with('success', 'Progetto creato con successo');
    }



    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Genera un nuovo slug se il titolo è cambiato
        if ($request->title !== $project->title) {
            $data['slug'] = Str::slug($request->title);
        }

        // Aggiorna il progetto con i nuovi dati
        $project->update($data);

        return redirect()->route('admin.projects.index', ['project' => $project->slug])->with('success', 'Progetto aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'post ' . $project->title . ' è stato cancellato');
    }
}
