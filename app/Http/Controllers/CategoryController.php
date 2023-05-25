<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get categories data and sort by ID
        $categories = Category::orderBy('id')->get();
        $navitem = 'produk';
        $navitemchild = 'kategori';

        // render view with categories data
        return view('categories.index', compact('categories', 'navitem', 'navitemchild'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navitem = 'produk';
        $navitemchild = 'kategori';

        // render view
        return view('categories.create', compact('navitem', 'navitemchild'));
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
            'name' => 'required|string|max:100',
        ]);

        //create category
        Category::create([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Kategori Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $navitem = 'produk';
        $navitemchild = 'kategori';

        // return view
        return view('categories.edit', compact('category', 'navitem', 'navitemchild'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validate form
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);

        //update category
        $category->update([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Kategori Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //delete category
        $category->delete();
        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Kategori Berhasil Dihapus!']);
    }
}
