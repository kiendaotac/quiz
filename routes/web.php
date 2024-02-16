<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => \Filament\Http\Middleware\Authenticate::class], function () {
    Route::get('dashboard', \App\Livewire\Dasboard::class)->name('dashboard');
    Route::get('danh-muc/{category}', \App\Livewire\Category::class)->name('category');
    Route::get('quiz/{exam}', \App\Livewire\Quiz::class)->name('quiz');
});

Route::get('logout', function () {
    auth()->logout();

    return redirect(\route('dashboard'));
})->name('user.logout')->middleware('guest');
