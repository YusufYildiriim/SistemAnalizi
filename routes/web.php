<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

// Anasayfa rotası, tartışmaların listelendiği sayfa
Route::get('/', [DiscussionController::class, 'index'])->name('homepage');

// Kullanıcı giriş ve kayıt rotaları
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Kullanıcı giriş yaptıktan sonra erişilebilen rotalar
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/discussions/create', [DiscussionController::class, 'create'])->name('discussions.create');
    Route::post('/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
    Route::get('/discussions/{id}', [DiscussionController::class, 'show'])->name('discussions.show');
    Route::delete('/discussions/{id}', [DiscussionController::class, 'destroy'])->name('discussions.destroy');
    Route::put('/discussions/{id}', [DiscussionController::class, 'update'])->name('discussions.update');
    Route::get('/discussions/{id}/edit', [DiscussionController::class, 'edit'])->name('discussions.edit');

    Route::post('/discussions/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
});

// Tartışmaları görüntüleme rotaları, giriş yapmadan da erişilebilir
Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions.index');
Route::get('/discussions/{id}', [DiscussionController::class, 'show'])->name('discussions.show');
