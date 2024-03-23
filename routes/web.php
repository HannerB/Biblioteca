<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
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
    Route::resource('book', BookController::class);

    // Ruta para mostrar los libros en la vista de asistencia
    Route::get('register-attendance', [BookController::class, 'showBooks'])->name('register-attendance');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('reports', function () {
    Gate::authorize('see-reports');
    return view('reports');
})->name('reports');

// No necesitas definir esta ruta dos veces
// Route::get('register-attendance', function () {
//     Gate::authorize('register-attendance');
//     return view('register-attendance');
// })->name('register-attendance');

require __DIR__.'/auth.php';
