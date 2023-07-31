<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\MemoController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ThemeController::class)->middleware(['auth'])->group(function(){
	Route::get('/themes/select', 'select')->name('theme.select');  // select one theme
	//Route::get('/themes/{theme}', 'index')->name('theme.index');
	Route::get('/themes/{theme}/memos', 'index')->name('theme.index');  // show memos of selected theme
	Route::post('/themes', 'access')->name('theme.access');  // redirect to 'theme.index'
});

Route::controller(FormatController::class)->middleware(['auth'])->group(function(){
	Route::get('/formats/cerate', 'createFirst')->name('format.createFirst');
	Route::post('/foramts/create', 'createSecond')->name('format.createSecond');
	//Route::get('/formats', 'store')->name('format.store');
	Route::get('/formats/{theme}/edit', 'edit')->name('format.edit');  // show edit 
	Route::put('/formats/{theme}', 'update')->name('format.update');
});

Route::controller(MemoController::class)->middleware(['auth'])->group(function(){
	Route::get('/themes/{theme}/memos/create', 'createFirst')->name('memo.createFirst');
	Route::post('/themes/{theme}/memos/create', 'createSecond')->name('memo.createSecond');
	Route::get('/themes/{theme}/memos/{memo}', 'show')->name('memo.show');  // show contents of the memo 
	//Route::get('/themes/{theme}/memos/create', 'create')->name('memo.create');  // use only when create
	Route::post('/themes/{theme}/memos/{memo}/edit', 'edit')->name('memo.edit');  // 
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
