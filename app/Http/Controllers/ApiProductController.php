<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(['data' => $products]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
        ]);

        // upload file
        $fileName = $this->generateRandomString();
        $extension = $request->file->extension();
        $image = $fileName . '.' . $extension;

        Storage::putFileAs('images', $request->file, $image);

        $request['image'] = $image;
        $request['status'] = 'waiting';
        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Data produk berhasil ditambahkan',
            'data' => $product,
        ]);
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function update(Request $request, $id)
    {
        //validate form
        $this->validate($request, [
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        if ($request->file) {
            // upload new file
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $fileName . '.' . $extension;

            Storage::putFileAs('images', $request->file, $image);

            // delete old file
            $oldImage = $product->image;
            if ($oldImage) {
                Storage::delete('images/' . $oldImage);
            }

            // update product dengan image
            $request['image'] = $image;
            $product->update($request->all());
        } else {
            // update product tanpa image
            $product->update($request->all());
        }

        return response()->json([
            'message' => 'Data product berhasil diupdate',
            'data' => $product,
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Data product berhasil dihapus',
            'data' => $product,
        ]);
    }
}
