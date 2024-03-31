<?php

// LoanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class LoanController extends Controller
{
    // Método para mostrar el formulario de solicitud de préstamo
    public function showLoanForm(Book $book)
    {
        return view('book.loan', compact('book'));
    }

    // Método para procesar la solicitud de préstamo
    public function submitLoanRequest(Request $request, Book $book)
    {
        // Validar los datos del formulario
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
        ]);

        // Crear un nuevo registro en la tabla loans
        // Aquí asumimos que tienes una relación llamada "loans" en el modelo Book
        $book->loans()->create([
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
            'duration' => $request->duration,
            // Puedes agregar más campos si es necesario
        ]);

        // Redirigir al usuario de vuelta al formulario de solicitud de préstamo con el libro
        return redirect()->route('books.loan', $book)->with('success', 'Solicitud de préstamo enviada correctamente');
    }
}


