<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;




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

Route::get('/contacts/create', 'ContactController@create');
Route::post('/contacts', 'ContactController@store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
