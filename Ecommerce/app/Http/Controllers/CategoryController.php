<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    // SHOW ALL CATEGORIES
    public function index()
    {
        $categories = Category::paginate(5);
        return response()->json([
            'categories' => $categories,
        ], 200);
    }

    // SHOW SPECIFIC CATEGORY ON THE BASE OF SLUG
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->get();
            return response()->json([
                'product' => $category,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Slug category not found',
            ], 404);
        }
    }

    // ADD CATEGORY
    public function store(CategoryRequest $request)
    {
        $validateData = $request->validated();
        $data = array_merge($validateData, ['slug' => Str::slug($validateData['name'])]);
        Category::create($data);
        return response()->json([
            'message' => 'New Category Added',
        ], 200);
    }

    // UPDATE CATEGORY
    public function update(CategoryRequest $request, $slug)
    {
        $validateData = $request->validated();
        $data = array_merge($validateData, ['slug' => Str::slug($validateData['name'])]);
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->update($data);
            return response()->json([
                'message' => 'Category Updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Slug category not found',
            ], 404);
        }
    }

    // DELETE CATEGORY
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->delete();
            return response()->json([
                'message' => 'Category Deleted',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Slug category not found',
            ], 404);
        }
    }
}
