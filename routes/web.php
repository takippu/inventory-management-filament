<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\SubcategoryResource;
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

// Route::middleware(['auth', 'filament'])
//     ->prefix('admin')
//     ->group(function () {
//         CategoryResource::routes();
//         SubcategoryResource::routes();
//     });