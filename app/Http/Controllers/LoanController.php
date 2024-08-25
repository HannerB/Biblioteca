<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;

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

    // Método para mostrar el formulario de devolución de préstamo
    public function showReturnForm()
    {
        // Obtener todos los préstamos activos del usuario actual
        $userLoans = Loan::where('user_id', auth()->id())
                        ->select('user_id', 'book_id', 'created_at') // Seleccionar la fecha de creación
                        ->get();

        // Verificar si se recuperan los préstamos correctamente
        if ($userLoans->isEmpty()) {
            // Si no hay préstamos activos, redirige o muestra un mensaje adecuado
            return redirect()->route('dashboard')->with('error', 'No tienes libros prestados actualmente.');
        }

        // Pasar los préstamos a la vista
        return view('loan.return', compact('userLoans'));
    }



    // Método para procesar la devolución de libros
    public function submitReturn(Request $request)
    {
        // Validar los datos del formulario si es necesario
        $request->validate([
            'loan_ids' => 'required|array',
            'loan_ids.*' => 'exists:loans,id', // Verificar que los IDs de los préstamos existan en la tabla loans
            'return_date' => 'required|date', // Validar la fecha de devolución
        ]);

        // Obtener los IDs de los préstamos a devolver
        $loanIds = $request->input('loan_ids');

        // Actualizar los préstamos seleccionados estableciendo la fecha de devolución
        Loan::whereIn('id', $loanIds)->update([
            'returned_at' => $request->return_date,
        ]);

        // Redirigir al usuario a donde sea necesario después de procesar la devolución
        return redirect()->route('dashboard')->with('success', 'Los libros han sido devueltos correctamente.');
    }
}
