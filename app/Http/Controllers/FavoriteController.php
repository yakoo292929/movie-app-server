<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/app/Http/Controllers/FavoriteController.php
 * PROGRAM NAME   : FavoriteController.php
 *                : Favoriteコントローラー
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FavoriteController extends Controller
{

  ///////////////////////////////////////////////////////////////
  // 一覧
  ///////////////////////////////////////////////////////////////
  public function index()
  {

    // APIキー取得
    $api_key = config('services.tmdb.api_key');

    // ユーザ情報からお気に入り情報取得
    $user = Auth::user();
    $favorites = $user->favorites;

    // お気に入りデータ展開→APIにで取得→配列に格納
    $details = [];
    foreach($favorites as $favorite) {
      $tmdb_api_kye = 'https://api.themoviedb.org/3/' . $favorite->media_type . '/' . $favorite->media_id . '?api_key=' . $api_key;
      $response = Http::get($tmdb_api_kye);

      // $details[] = $response->json();
      $details[] = array_merge($response->json(), ['media_type' => $favorite->media_type]);

    }
    return response()->json($details);

  }

  ///////////////////////////////////////////////////////////////
  // 登録・解除
  ///////////////////////////////////////////////////////////////
  public function toggleFavorite(Request $request)
  {

    // バリデーションチェック
    $validatedData = $request->validate([
      'media_id' => 'required|integer',
      'media_type' => 'required|string',
    ]);

    // 存在チェック
    $existingFavorite = Favorite::where('user_id', Auth::id())
      ->where('media_type', $validatedData["media_type"])
      ->where('media_id', $validatedData["media_id"])
      ->first();

    // 登録・解除
    if ($existingFavorite) {
        // お気に入りが既に存在している場合
        $existingFavorite->delete();
        return response()->json(["status" => "removed"]);
    } else {
        // お気に入りが存在していない場合
        Favorite::create([
          'media_type' => $validatedData["media_type"],
          'media_id' => $validatedData["media_id"],
          'user_id' => Auth::id(),
        ]);
        return response()->json(["status" => "added"]);
    }

  }

  ///////////////////////////////////////////////////////////////
  // 状態チェック
  ///////////////////////////////////////////////////////////////
  public function checkFavoriteStatus(Request $request)
  {

    // バリデーションチェック
    $validatedData = $request->validate([
      'media_id' => 'required|integer',
      'media_type' => 'required|string',
    ]);

    // 存在チェック(存在していればtrue していなければfalse)
    $isFavorite = Favorite::where('user_id', Auth::id())
      ->where('media_type', $validatedData["media_type"])
      ->where('media_id', $validatedData["media_id"])
      ->exists();

      return response()->json($isFavorite);

  }

}
