<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(12);
        return view('register-attendance', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('book.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:30',
            'author' => 'required|max:30',
            'quantity' => 'required|numeric',
            'category' => 'nullable|exists:categories,id',
        ]);

        $book = Book::create($validatedData);

        if ($request->has('category')) {
            $book->categories()->attach($request->input('category'));
        }

        Session::flash('success', 'Libro creado con éxito!');
        return redirect()->route('register-attendance');
    }

    public function show()
    {
        $books = Book::paginate(12);
        $userRole = Auth::user()->role;
        return view('libros', compact('books', 'userRole'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('book.form', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:30',
            'author' => 'required|max:30',
            'quantity' => 'required|numeric',
            'category' => 'nullable|exists:categories,id',
        ]);

        $book->update($validatedData);

        $book->categories()->sync($request->input('category', []));

        Session::flash('success', 'Libro actualizado con éxito!');
        return redirect()->route('register-attendance');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        Session::flash('success', 'Se ha eliminado con éxito!');
        return redirect()->route('register-attendance');
    }

    public function search(Request $request)
    {
        if (auth()->user()->role == User::ROLE_STUDENT) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $searchTerm = $request->input('search');
        $books = Book::where('title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('author', 'LIKE', "%{$searchTerm}%")
            ->paginate(12);

        return view('register-attendance', compact('books'));
    }

    public function searchBook(Request $request)
    {
        $searchTerm = $request->input('search');
        $userRole = Auth::user()->role;
        $books = Book::where('title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('author', 'LIKE', "%{$searchTerm}%")
            ->paginate(12);

        return view('book.search-results', compact('books', 'searchTerm', 'userRole'));
    }
}
