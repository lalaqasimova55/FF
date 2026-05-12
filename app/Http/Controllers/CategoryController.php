<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('tasks')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'color' => 'required|string',
        ]);

        Category::create($request->only('name', 'color'));
        return redirect()->route('categories.index')->with('success', 'Kateqoriya əlavə edildi!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'color' => 'required|string',
        ]);

        $category->update($request->only('name', 'color'));
        return redirect()->route('categories.index')->with('success', 'Kateqoriya yeniləndi!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kateqoriya silindi!');
    }
}