<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Rutas para el perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para los libros
    Route::resource('book', BookController::class)->except('index'); // Excluir la ruta 'index'
    Route::get('/books/search', [BookController::class, 'search'])->name('book.search');
    Route::get('/books/rol', [BookController::class, 'searchBook'])->name('book.searchBook');

    // Rutas para las categorías
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
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
