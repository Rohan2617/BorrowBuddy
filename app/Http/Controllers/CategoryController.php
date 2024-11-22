<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.categories', [ 'categories' => $categories ]);
    }

    /**
     * Display a listing of the resource for users.
     */
    public function userIndex()
    {
        $categories = Category::get();

        return view('categories', [ 'categories' => $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.forms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect(route('categories.index'))->with('message', 'Category Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('id', $id)->first();

        return view('admin.forms.category.update', $category);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, string $id)
    {
        Category::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect(route('categories.index'))->with('message', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();

        return redirect(route('categories.index'))->with('message', 'Category Deleted');
    }
}
