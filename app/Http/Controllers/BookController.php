<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(12); // Obtener libros paginados
        return view('register-attendance', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'author' => 'required|max:30',
            'quantity' => 'required|max:3'
        ]);

        $book = Book::create($request->only('title', 'author', 'quantity'));

        Session::flash('mensaje', 'Se ha guardado con Éxito!');

        return redirect()->route('register-attendance');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $books = Book::paginate(12);
        $userRole = Auth::user()->role;
        return view('libros', compact('books', 'userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('book.form')
            ->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|max:30',
            'author' => 'required|max:30',
            'quantity' => 'required|max:3'
        ]);

        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->quantity = $request['quantity'];
        $book->save();

        $book = Book::create($request->only('title', 'author', 'quantity'));

        Session::flash('mensaje', 'Se ha guardado con Éxito!');

        return redirect()->route('register-attendance');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        Session::flash('mensaje', 'Se ha eliminado con Éxito!');

        return redirect()->route('register-attendance');
    }

    public function search(Request $request)
    {
        // Verificar el rol del usuario
        if (auth()->user()->role == User::ROLE_STUDENT) {
            // Redirigir al usuario a una página de acceso denegado
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
