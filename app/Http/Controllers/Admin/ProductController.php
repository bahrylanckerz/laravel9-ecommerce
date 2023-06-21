<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        return view('admin.product.index', $data);
    }

    public function create()
    {
        $data['categories']    = Category::orderBy('name', 'asc')->get();
        $data['subcategories'] = SubCategory::orderBy('name', 'asc')->get();
        return view('admin.product.create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'product_code'   => 'required|unique:products',
            'name'           => 'required',
            'details'        => 'required',
            'description'    => 'required',
            'price'          => 'required',
            'quantity'       => 'required',
            'image'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'category_id'    => 'required',
            'subcategory_id' => 'required',
        ];

        $request->validate($rules);

        $image = $request->file('image');
        $filename = date('YmdHis').'.'.$image->getClientOriginalExtension();
        $request->image->move(public_path('admin/uploads/products'), $filename);

        Product::create([
            'product_code'   => $request->product_code,
            'name'           => $request->name,
            'slug'           => Str::slug($request->name),
            'details'        => $request->details,
            'description'    => $request->description,
            'price'          => $request->price,
            'quantity'       => $request->quantity,
            'image'          => $filename,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        Category::where('id', $request->category_id)->increment('product_count');
        SubCategory::where('id', $request->subcategory_id)->increment('product_count');

        return redirect()->route('admin.product')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $data['categories']    = Category::orderBy('name', 'asc')->get();
        $data['subcategories'] = SubCategory::orderBy('name', 'asc')->get();
        $data['product']       = Product::findOrFail($id);
        return view('admin.product.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = [
            'name'           => 'required',
            'details'        => 'required',
            'description'    => 'required',
            'price'          => 'required',
            'quantity'       => 'required',
            'category_id'    => 'required',
            'subcategory_id' => 'required',
        ];

        $request->validate($rules);

        $product = Product::findOrFail($request->id);

        Category::where('id', $product->category_id)->decrement('product_count');
        SubCategory::where('id', $product->subcategory_id)->decrement('product_count');

        Product::findOrFail($request->id)->update([
            'name'           => $request->name,
            'slug'           => Str::slug($request->name),
            'details'        => $request->details,
            'description'    => $request->description,
            'price'          => $request->price,
            'quantity'       => $request->quantity,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        Category::where('id', $request->category_id)->increment('product_count');
        SubCategory::where('id', $request->subcategory_id)->increment('product_count');

        return redirect()->route('admin.product')->with('success', 'Product updated successfully');
    }

    public function updateimage(Request $request, $id)
    {
        $rules = [
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $request->validate($rules);

        $image = $request->file('image');
        $filename = date('YmdHis') . '.' . $image->getClientOriginalExtension();
        $path = public_path('admin/uploads/products');
        $request->image->move($path, $filename);

        $product = Product::findOrFail($id);

        if (is_file($path . '/' . $product->image)) {
            unlink($path . '/' . $product->image);
        }

        Product::findOrFail($id)->update([
            'image' => $filename,
        ]);

        return redirect()->route('admin.product')->with('success', 'Image updated successfully');
    }

    public function delete($id)
    {
        $category_id = Product::where('id', $id)->value('category_id');
        $subcategory_id = Product::where('id', $id)->value('subcategory_id');

        Product::findOrFail($id)->delete();

        Category::where('id', $category_id)->decrement('product_count');
        SubCategory::where('id', $subcategory_id)->decrement('product_count');

        return redirect()->route('admin.product')->with('success', 'Product deleted successfully');
    }
}
