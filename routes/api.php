<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/files', [FileController::class, 'index'])->name('files.index');
