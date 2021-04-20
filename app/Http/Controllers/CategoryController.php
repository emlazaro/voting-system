<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Nominee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Categories/Index', [
            'Categories' => Category::with('nominees.user')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'unique:categories', 'max:50'],
            'max_selection' => ['required']
        ]);

        $category = Category::create([
            'name' => $request->name,
            'max_selection' => $request->max_selection
        ]);

        return redirect()->route('categories')->with(['success' => 'Category Created...']);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return Inertia::render('Categories/Edit', [
            'editCategory' => $category
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:categories,name, ' . $request->id],
            'max_selection' => ['required']
        ])->validate();

        $category = Category::find($request->id);
        $category->update($request->only(['name', 'max_selection']));
        $category->save();

        return redirect()->route('categories')->with(['success' => 'Category has been updated!!!']);
    }

    public function destroy(Category $category)
    {
        Nominee::where('category_id', $category->id)->delete();
        $category->delete();

        return redirect()->route('categories')->with(['success' => 'Category data has been deleted']);
    }
}
