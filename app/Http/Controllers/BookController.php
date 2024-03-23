<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10); // Obtener libros paginados
        return view('register-attendance', compact('books'));
    }
    
    public function showBooks()
    {
        $books = Book::paginate(10); // Obtener libros paginados
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
            'title'=> 'required|max:30',
            'author'=> 'required|max:30',
            'quantity'=> 'required|max:3'
        ]);

        $book = Book::create($request->only('title','author','quantity'));

        Session::flash('mensaje','´Se ha guardado con Éxito!');

        return redirect()->route('book.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
