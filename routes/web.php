<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetLikeController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::resource('tweets', TweetController::class);
  Route::post('/tweets/{tweet}/like', [TweetLikeController::class, 'store'])->name('tweets.like');
  Route::delete('/tweets/{tweet}/like', [TweetLikeController::class, 'destroy'])->name('tweets.dislike');
  Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow.store');
  Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])->name('follow.destroy');
  Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow');
  Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])->name('unfollow');
});

require __DIR__ . '/auth.php';
