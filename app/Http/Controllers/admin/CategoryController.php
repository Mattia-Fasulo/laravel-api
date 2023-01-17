<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;




class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $slug = Category::generateSlug($request->name);
        $data['slug'] = $slug;
        $new_category = Category::create($data);
        return redirect()->route('admin.categories.index', $new_category->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     */
    // public function show(Category $category)
    // {

    //     return view('admin.categories.show', compact('category'));
    // }

    public function show($slug)
    {
        if(Auth::user()->isAdmin()){
            $category = Category::where('slug', $slug)->first();
        } else {
            $category = Category::where('slug', $slug)->with([
                'projects' => function ($query) {
                    $query->where('user_id', Auth::id());
                }
            ])->first();
        }

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $slug = Category::generateSlug($request->name);
        $data['slug'] = $slug;
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('message', "$category->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', "$category->title deleted successfully");
    }
}
