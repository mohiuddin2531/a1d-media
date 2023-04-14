<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StatusController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/', function(){
        return redirect()->route('home');
    });

    Route::get('/newsfeed', [StatusController::class, 'newsfeedStatus'])->name('newsfeed');
    Route::get('/user/profile', [UserProfileController::class, 'showProfile'])->name('showProfile');
    Route::post('/post_status', [StatusController::class, 'postStatus'])->name('postStatus');

    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');



    Route::post('/react/{status}', [StatusController::class, 'postReact'])->name('react_status');



});