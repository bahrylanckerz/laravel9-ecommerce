<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data['subcategories'] = SubCategory::all();
        return view('admin.subcategory.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        return view('admin.subcategory.create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'        => 'required|unique:sub_categories',
            'category_id' => 'required',
        ];

        $request->validate($rules);

        SubCategory::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        Category::where('id', $request->category_id)->increment('subcategory_count');

        return redirect()->route('admin.subcategory')->with('success', 'Sub Category created successfully');
    }

    public function edit($id)
    {
        $data['categories']  = Category::orderBy('name', 'asc')->get();
        $data['subcategory'] = SubCategory::findOrFail($id);
        return view('admin.subcategory.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = [
            'name'        => 'required',
            'category_id' => 'required',
        ];

        $request->validate($rules);

        $category_id = SubCategory::where('id', $request->id)->value('category_id');

        Category::where('id', $category_id)->decrement('subcategory_count');

        SubCategory::findOrFail($request->id)->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        Category::where('id', $request->category_id)->increment('subcategory_count');

        return redirect()->route('admin.subcategory')->with('success', 'Sub Category updated successfully');
    }

    public function delete($id)
    {
        $category_id = SubCategory::where('id', $id)->value('category_id');

        SubCategory::findOrFail($id)->delete();

        Category::where('id', $category_id)->decrement('subcategory_count');

        return redirect()->route('admin.subcategory')->with('success', 'Sub Category deleted successfully');
    }

}
