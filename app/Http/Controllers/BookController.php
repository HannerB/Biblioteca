<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
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
        $request->validate([
            'title' => 'required|max:30',
            'author' => 'required|max:30',
            'quantity' => 'required|numeric',
            'category' => 'nullable|exists:categories,id',
        ]);

        $bookData = $request->only('title', 'author', 'quantity');
        $book = Book::create($bookData);

        if ($request->has('category')) {
            $book->categories()->attach($request->input('category'));
        }

        Session::flash('mensaje', 'Libro creado con éxito!');
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
        $request->validate([
            'title' => 'required|max:30',
            'author' => 'required|max:30',
            'quantity' => 'required|numeric',
            'category' => 'nullable|exists:categories,id',
        ]);

        $book->update($request->only('title', 'author', 'quantity'));

        if ($request->has('category')) {
            $book->categories()->sync([$request->input('category')]);
        } else {
            $book->categories()->detach();
        }

        Session::flash('mensaje', 'Libro actualizado con éxito!');
        return redirect()->route('register-attendance');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        Session::flash('mensaje', 'Se ha eliminado con Éxito!');
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
