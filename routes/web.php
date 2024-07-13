<?php

use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', function () {
    return redirect()->route('register');
});

//Route::resource('contato', ContactsController::class)
//    ->only(['create','store', 'edit','update', 'destroy'])
//    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ContactsController::class, 'index'])->name('dashboard');
    Route::get('/contato', [ContactsController::class, 'create'])->name('contato.create');
    Route::get('/contato/{id}', [ContactsController::class, 'edit'])->name('contato.edit');
    Route::post('/contato', [ContactsController::class, 'store'])->name('contato.store');
    Route::put('/contato/{id}', [ContactsController::class, 'update'])->name('contato.update');
    Route::delete('/contato/{id}', [ContactsController::class, 'destroy'])->name('contato.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/dashboard', [ContactsController::class, 'index'])->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';
