<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;





Route::get('/',[PostController::class,'index'])->name('post.index');
Route::get('/{post}',[PostController::class,'show'])->name('post.show');