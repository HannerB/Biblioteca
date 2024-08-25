<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    // Rutas para el perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para los libros
    Route::resource('books', BookController::class)->except('index');
    Route::get('/books/search', [BookController::class, 'search'])->name('book.search');
    Route::get('/books/rol', [BookController::class, 'searchBook'])->name('book.searchBook');

    // Rutas para las categorías
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create'); // Cambiar 'category' a 'categories'
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store'); // Cambiar 'category' a 'categories'
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit'); // Cambiar 'category' a 'categories'
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update'); // Cambiar 'category' a 'categories'
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy'); // Cambiar 'category' a 'categories'

    // Rutas para los préstamos
    // Route::get('/books', [LoanController::class, 'showLoanBooks'])->name('books.index'); // Cambiar el nombre de la ruta
    Route::get('/books/{book}/loan', [LoanController::class, 'showLoanForm'])->name('books.loan');
    Route::post('/books/{book}/loan', [LoanController::class, 'submitLoanRequest'])->name('books.submit_loan');
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

// Otras rutas
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('libros', [BookController::class, 'show'])->name('libros');

Route::get('reports', function () {
    Gate::authorize('see-reports');
    return view('reports');
})->name('reports');

// Ruta para mostrar las categorías
Route::get('/register-categories', [CategoryController::class, 'index'])->name('register-categories');

require __DIR__ . '/auth.php';
