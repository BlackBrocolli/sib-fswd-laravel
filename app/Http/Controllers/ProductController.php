<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ViewProduct;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $categories = Category::orderBy('name')->get();
        // $viewproducts = ViewProduct::latest()->get();
        $navitem = 'produk';
        $navitemchild = 'daftar-produk';

        // render view with product data
        return view('products.index', compact('products',  'navitem', 'navitemchild', 'categories'));
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
            'description' => 'required|string',
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
            'created_by' => Auth::user()->id,
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
        $navitem = 'produk';
        $navitemchild = 'daftar-produk';
        $categories = Category::orderBy('name')->get();

        //return view
        return view('products.show', compact('categories', 'navitem', 'navitemchild', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $navitem = 'produk';
        $navitemchild = 'daftar-produk';

        // return view
        return view('products.edit', compact('product', 'categories', 'navitem', 'navitemchild'));
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
        //validate form
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'category' => 'required',
            'price' => 'required|numeric',
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $imageName = $image->hashName();
            // resize image agar serasi
            $imagePath = 'assets-landing/img/portfolio/' . $imageName;
            Image::make($image)
                ->resize(800, 600)
                ->save(public_path($imagePath));

            //delete old image
            $oldImagePath = public_path('assets-landing/img/portfolio/' . $product->image);
            File::delete($oldImagePath);

            //update product with new image
            $product->update([
                'image' => $imageName,
                'name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
                // status default waiting
                'status' => 'waiting',
            ]);
        } else {
            //update user without avatar
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
                // status default waiting
                'status' => 'waiting',
            ]);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Produk Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete image
        $oldImagePath = public_path('assets-landing/img/portfolio/' . $product->image);
        File::delete($oldImagePath);

        //delete product
        $product->delete();
        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Produk Berhasil Dihapus!']);
    }

    public function accept($id)
    {

        $product = Product::findOrFail($id);
        $product->update([
            'status' => 'accepted',
            'verified_by' => Auth::user()->id,
            'verified_at' => Carbon::now(),
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Product diterima!']);
    }

    public function reject($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => 'rejected',
            'verified_by' => Auth::user()->id,
            'verified_at' => Carbon::now(),
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Product ditolak!']);
    }
}
