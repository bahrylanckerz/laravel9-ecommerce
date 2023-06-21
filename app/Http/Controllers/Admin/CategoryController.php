<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();
        return view('admin.category.index', $data);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|unique:categories'];

        $request->validate($rules);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.category')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $data['category'] = Category::findOrFail($id);
        return view('admin.category.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = ['name' => 'required|unique:categories'];

        $request->validate($rules);

        Category::findOrFail($request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('admin.category')->with('success', 'Category deleted successfully');
    }
}
