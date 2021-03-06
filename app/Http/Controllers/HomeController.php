<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::paginate();
        return view('home', compact('categories'));
    }

    public function category (Category $category)
    {
        $products = Product::with('category')->where('category_id', $category->id)->paginate(4);
        return view('category', compact('products'));
    }
}
