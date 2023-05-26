<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ViewProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get product data
        $products = Product::latest()->get();
        $viewproducts = ViewProduct::latest()->get();
        $navitem = 'produk';
        $navitemchild = 'daftar-produk';

        // render view with product data
        return view('products.index', compact('products',  'navitem', 'navitemchild', 'viewproducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $navitem = 'produk';
        $navitemchild = 'daftar-produk';

        // render view
        return view('products.create', compact('categories', 'navitem', 'navitemchild'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'category' => 'required',
            'price' => 'required|numeric',
        ]);



        //upload image
        $image = $request->file('image');
        $imageName = $image->hashName();
        // $image->storeAs('public/assets-landing/img/portfolio', $imageName);

        // resize image agar serasi
        $imagePath = 'assets-landing/img/portfolio/' . $imageName;
        Image::make($image)
            ->resize(800, 600)
            ->save(public_path($imagePath));

        //create product
        Product::create([
            'image' => $imageName,
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            // status default waiting
            'status' => 'waiting',
            // created_by sementara 1 dulu
            // karena belum ada user login
            'created_by' => 1,
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Produk Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
