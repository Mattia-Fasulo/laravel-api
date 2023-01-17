<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){

        $projects = Project::with('category', 'tags')->paginate(3);
        return response()->json([
            'success' => true,
            'result' => $projects
        ]);


    }

    public function show($slug){
        $project = Project::with('category', 'tags')->where('slug', $slug)->first();
        if($project){
            return response()->json([
                'success' => true,
                'result' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'No projects found'
            ]);
        }
    }
}
