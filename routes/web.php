<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('contact', 'contact')->name('contact');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('records', function (){
        Route::redirect('/', '/admin/records');
        $records = [
            'Queen - Greatest Hits',
            'The Rolling Stones - Sticky Fingers',
            'The Beatles - Abbeygit Road'
        ];
        return view('admin.records.index', [
            'records' => $records
        ]);
    })->name('records');
    Route::view('download_covers', 'admin.download_covers')->name('download_covers');
});
Route::view('playground', 'playground')->name('playground');
Route::view('under-construction', 'under-construction')->name('under-construction');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
