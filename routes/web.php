<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


// Adding some change to web.php to demonstrate the collbaration

Route::get('/home', function () {
    return view('home');
});

Route::get('/', function () {
    return view('home');
});

Route::get('contacts', function () {
    return view('contacts/contacts');
});

Route::get('create', function () {
    return view('contacts/create');
});


Route::get('/contacts/create', [ContactController::class, 'create']);

Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/contacts', [ContactController::class, 'showContacts']);

Route::get('/contacts/{id}/edit', [ContactController::class, 'edit' ])->name('contacts.edit');

Route::patch('/contacts/{id}', [ContactController::class, 'update' ])->name('contacts.update');

Route::delete('/contacts/{id}', [ContactController::class, 'destroy' ])->name('contacts.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
