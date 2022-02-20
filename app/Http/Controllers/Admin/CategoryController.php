<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->paginate(20);
        $dir =  '/public/export/';
        $files = Storage::files($dir);

        return view('admin.categories.index', compact('categories', 'files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'picture' => 'nullable|image'
        ]);

        $data = $request->all();
        $data['picture'] = $request->file('picture')->store('public/category');


        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Категория сохранена');
    }

    public function show($category)
    {
        $categories = Category::all();
        $products = Product::with('category')->where('category_id', $category)->orderBy('name', 'asc')->paginate(10);
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'picture' => 'nullable|image'
        ]);

        $category = Category::find($id);
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('public/category');

        }
//        $data['picture'] = $request->file('picture')->store('public/category');
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Категория обновлена');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->products->count()){
             return back()->with('error', 'У категории есть продукты');
        }
        Storage::delete($category->picture);
        $category->delete();
        return back()->with('success', 'Категория удалена');
    }
}
