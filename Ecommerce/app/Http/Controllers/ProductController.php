<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // SHOW ALL PRODUCTS
    public function index()
    {
        $products = Product::with('category:id,name')->paginate(10);
        return response()->json([
            'products' => $products,
        ], 200);
    }

    // SHOW SPECIDIC PRODUCT ON THE BASE OF ID
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->get();
            return response()->json([
                'product' => $product,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id product not found',
            ], 404);
        }
    }

    // ADD PRODUCT
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile("image")) {
            $image = $request->file('image');
            $destinationPath = 'images/products/';
            $imgNewName = time() . "-" . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgNewName);
            $data['image'] = $imgNewName;
        }
        Product::create($data);
        return response()->json([
            'message' => 'Product Added',
        ], 200);
    }

    // UPDATE PRODUCT
    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile("image")) {
            $destinationPath = 'images/products/' . $data['image'];
            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }
            $image = $request->file('image');
            $destinationPath = 'images/product/';
            $imgNewName = time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imgNewName);
            $data['image'] = $imgNewName;
        }
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            return response()->json([
                'message' => 'Product Updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id product not found',
            ], 404);
        }
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::findorFail($id);
        $destination = 'images/products/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        return response()->json([
            'message' => 'Product Deleted',
        ], 200);
    }

    // SEARCH PRODUCT
    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::where('title', 'like', "%{$query}%")->orwhere('description', 'like', "%{$query}%")->get();
        return response()->json([
            'products' => $products,
        ], 200);
    }
}
