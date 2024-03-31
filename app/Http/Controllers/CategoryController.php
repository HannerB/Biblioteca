<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(12);
        return view('register-categories', compact('categories'));
    }

    public function create()
    {
        return view('category.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30|unique:categories'
        ]);

        Category::create($request->only('name'));

        Session::flash('mensaje', 'Se ha guardado con éxito!');

        return redirect()->route('register-categories');
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('category.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:30|unique:categories,name,' . $category->id
        ]);

        $category->update($request->only('name'));

        Session::flash('mensaje', 'Se ha actualizado con éxito!');

        return redirect()->route('register-categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        Session::flash('mensaje', 'Se ha eliminado con éxito!');

        return redirect()->route('register-categories');
    }
}
