<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/routes/api.php
 * PROGRAM NAME   : api.php
 *                : api ルーティング
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

///////////////////////////////////////////////////////////////
// レビュー機能
///////////////////////////////////////////////////////////////
// 一覧
Route::get('/reviews/{media_type}/{media_id}', [ReviewController::class, 'index']);

// 登録
Route::post('/reviews', [ReviewController::class, 'store']);

// 削除
Route::delete('/review/{review}', [ReviewController::class, 'destroy']);

// 更新
Route::put('/review/{review}', [ReviewController::class, 'update']);

// 詳細
Route::get('/review/{review}', [ReviewController::class, 'show']);


///////////////////////////////////////////////////////////////
// コメント機能
///////////////////////////////////////////////////////////////
// 登録
Route::post('/comments', [CommentController::class, 'store']);

// 削除
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

// 更新
Route::put('/comment/{comment}', [CommentController::class, 'update']);


///////////////////////////////////////////////////////////////
// お気に入り機能
///////////////////////////////////////////////////////////////
// 一覧
Route::get('/favorites', [FavoriteController::class, 'index']);

// 登録・解除
Route::post('/favorites', [FavoriteController::class, 'toggleFavorite']);

// 状態チェック
Route::get('/favorites/status', [FavoriteController::class, 'checkFavoriteStatus']);



