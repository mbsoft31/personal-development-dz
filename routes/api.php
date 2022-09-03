<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('books', BookController::class, [
    "only" => ["index", "store", "update", "show", "destroy"]
]);

Route::resource('courses', CourseController::class, [
    "only" => ["index", "store", "update", "show", "destroy"]
]);

Route::resource('files', \App\Http\Controllers\AttachmentController::class);

