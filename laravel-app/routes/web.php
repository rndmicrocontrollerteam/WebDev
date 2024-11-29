<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('form');
// });

// Route::post('/submit', function (Illuminate\Http\Request $request) {
//     // Simpan data atau proses sesuai keinginan
//     return "Data berhasil dikirim: Nama - " . $request->name . ", Email - " . $request->email;
// });
Route::get('/form', [UserController::class, 'showForm']);
Route::post('/submit', [UserController::class, 'submitForm']);