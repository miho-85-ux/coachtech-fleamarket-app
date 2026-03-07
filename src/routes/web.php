<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ItemController::class, 'index']);

Route::get('/item/{item}', [ItemController::class, 'detail']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

Route::middleware('auth','verified')->group(function() 
{
    Route::get('/mypage', [MypageController::class, 'index']);
    Route::get('/mypage/profile', [MypageController::class, 'edit']);
    Route::post('/mypage/profile', [MypageController::class, 'update']);
    Route::post('/products/{product}/like', [LikeController::class, 'toggle']);
    Route::post('/products/{product}/comment', [CommentController::class, 'store']);
    Route::get('/sell', [SellController::class, 'index']);
    Route::post('/sell', [SellController::class, 'store']);
    Route::get('/purchase/{item}', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('/purchase/address/{item}', [PurchaseController::class, 'indexAddress']);
    Route::post('/purchase/address/{item}', [PurchaseController::class, 'editAddress']);
    Route::post('/purchase/{item}', [PurchaseController::class, 'store']);
    
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/mypage/profile');
}) ->middleware(['auth', 'signed']) -> name('verification.verify');
