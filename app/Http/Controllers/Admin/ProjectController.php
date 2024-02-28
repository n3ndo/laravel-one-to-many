<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->all();

        $new_project = new Project();
        
        if($request->hasFile('cover_image')){
            $path = Storage::disk('public')->put('project_image', $form_data['cover_image']);
            $form_data['cover_image'] = $path;

        }

        $validatedData = $request->validate([
            'title' => 'required|max:100|unique:projects',
            'content' => 'required',
            'cover_image' => 'image|nullulable',
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'Il titolo non deve superare i 100 caratteri',
            'title.unique' => 'Questo titolo esiste già',
            'content.required' => 'Il contenuto è obbligatorio',

        ]
        );


        $new_project->title = $form_data['title'];
        $new_project->content = $form_data['content'];
        $slug = Str::slug($new_project->title, '-');
        $new_project->slug = $slug;
        $new_project->cover_image = $form_data['cover_image'];

        $new_project->type_id = $form_data['type_id'];

        $new_project->save();

        return redirect()->route('admin.projects.index', ['project' => $new_project->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::find($project->id);

        $types = Type::all();
        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);

        $types = Type::all();

        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        $project = Project::find($project->id);

        $project->title = $form_data['title'];
        $project->content = $form_data['content'];
        $slug = Str::slug($project->title, '-');
        $project->slug = $slug;

        $project->type_id = $form_data['type_id'];

        $project->update();

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project = Project::find($project->id);
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
