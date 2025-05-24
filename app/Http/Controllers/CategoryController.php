<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('todos')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string|max:255',
    ]);

    Category::create([
        'title' => $request->title,
        'user_id' => auth()->id(), 
    ]);

    return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }

}