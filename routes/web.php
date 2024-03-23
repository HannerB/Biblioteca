<?php

use App\Models\User;
use App\Models\Book;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Rutas para el perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para los libros
    Route::resource('book', BookController::class)->except('index'); // Excluir la ruta 'index'

    Route::get('/books/search', [BookController::class, 'search'])->name('book.search');

    Route::get('/books/rol', [BookController::class, 'searchBook'])->name('book.searchBook');
});

// Ruta para mostrar los libros en la vista de asistencia (fuera del grupo de rutas protegidas)
Route::get('register-attendance', function () {
    if (Gate::allows('register-attendance')) {
        $books = Book::paginate(12); // Obtener libros paginados
        return view('register-attendance', compact('books'));
    } else {
        abort(403, 'No tienes permiso para acceder a esta página.');
    }
})->name('register-attendance')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('libros', [BookController::class, 'show'])->name('libros');

Route::get('reports', function () {
    Gate::authorize('see-reports');
    return view('reports');
})->name('reports');

require __DIR__ . '/auth.php';
