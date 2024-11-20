<?php

use App\Http\Middleware\ActiveUser;
use App\Http\Middleware\Admin;
use App\Livewire\Admin\Genres;
use Illuminate\Support\Facades\Route;
use App\Livewire\Demo;
use App\Livewire\Shop;

Route::view('/', 'home')->name('home');
Route::get('shop', Shop::class)->name('shop');
Route::view('contact', 'contact')->name('contact');
Route::middleware(['auth', Admin::class, ActiveUser::class])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('genres', Genres::class)->name('genres');
    Route::get('records', Demo::class)->name('records');
//    Route::get('records', function (){
//        Route::redirect('/', '/admin/records');
//        $records = [
//            'Queen - Greatest Hits',
//            'The Rolling Stones - Sticky Fingers',
//            'The Beatles - Abbeygit Road'
//        ];
//        return view('admin.records.index', [
//            'records' => $records
//        ]);
//    })->name('records');

    Route::view('download_covers', 'admin.download_covers')->name('download_covers');
});
Route::view('playground', 'playground')->name('playground');
Route::view('under-construction', 'under-construction')->name('under-construction');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ActiveUser::class,
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
