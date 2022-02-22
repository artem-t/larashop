<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->orderBy('name', 'asc')->paginate(9);
//        $dir =  '/public/export/products';
//        $files = Storage::files($dir);
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'picture' => 'nullable|image'
        ]);

        $data = $request->all();
        $data['picture'] = $request->file('picture')->store('public/product');

        Product::create($data);

        return redirect()->route('products.index')->with('sucsess', 'Продукт сохранен');


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'picture' => 'nullable|image'
        ]);

        $product = Product::find($id);
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('public/category');

        }
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Продукт обновлен');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->orders->count()){
            return back()->with('error', 'Продукт есть в заказах');
        }

        Storage::delete($product->picture);
        $product->delete();
        return back()->with('success', 'Продукт удален');
    }
}
