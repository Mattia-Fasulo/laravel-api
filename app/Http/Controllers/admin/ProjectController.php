<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        if (Auth::user()->isAdmin()) {
            $projects = Project::paginate(10);
        } else {
            $userId = Auth::id();
            $projects = Project::where('user_id', $userId)->paginate(10);
        }


        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.projects.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreProjectRequest $request)
    {
        $userId = Auth::id();
        $data = $request->validated();
        $slug = Project::generateSlug($request->title);
        $data['slug'] = $slug;
        $data['user_id'] = $userId;
        if ($request->hasFile('cover_image')) {
            $path = Storage::put('projects_images', $request->cover_image);
            $data['cover_image'] = $path;
        }

        $new_project = Project::create($data);

        if ($request->has('tags')) {
            $new_project->tags()->attach($request->tags);
        }

        return redirect()->route('admin.projects.show', $new_project->slug);
    }

    /**
     * Display the specified resource.
     *F
     * @param  int  $id
     */
    public function show(Project $project)
    {
        if (!Auth::user()->isAdmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Project $project)
    {
        if (!Auth::user()->isAdmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::all();
        $tags = Tag::all();
        if (!Auth::user()->isAdmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        return view('admin.projects.edit', compact('project', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        if (!Auth::user()->isAdmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        $data = $request->validated();
        $slug = Project::generateSlug($request->title);
        $data['slug'] = $slug;
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $path = Storage::put('project_images', $request->cover_image);
            $data['cover_image'] = $path;
        }


        $project->update($data);

        if ($request->has('tags')) {
            $project->tags()->sync($request->tags);
        } else {
            $project->tags()->sync([]);
        }
        return redirect()->route('admin.projects.index')->with('message', "$project->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Project $project)
    {
        if (!Auth::user()->isAdmin() && $project->user_id !== Auth::id()) {
            abort(403);
        }
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$project->title deleted successfully");
    }
}
