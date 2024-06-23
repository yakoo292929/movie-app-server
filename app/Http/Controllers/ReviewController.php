<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/app/Http/Controllers/ReviewController.php
 * PROGRAM NAME   : ReviewController.php
 *                : Reviewコントローラー
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

  ///////////////////////////////////////////////////////////////
  // 一覧
  ///////////////////////////////////////////////////////////////
  public function index($media_type, $media_id)
  {

    // 全レビュー取得
    // $reviews = Review::all();
    // return response()->json($reviews);

    // 指定レビュー取得
    $reviews = Review::with('user')
      ->where('media_type', $media_type)
      ->where('media_id', $media_id)
      ->get();
    return response()->json($reviews);

  }


  ///////////////////////////////////////////////////////////////
  // 登録
  ///////////////////////////////////////////////////////////////
  public function store(Request $request)
  {

    // バリデーションチェック
    $validatedData = $request->validate([
      'content' => 'required|string',
      'rating' => 'required|integer',
      'media_id' => 'required|integer',
      'media_type' => 'required|string',
    ]);

    // データベース登録
    $review = Review::create([
      'user_id' => Auth::id(),
      'content' => $validatedData["content"],
      'rating' => $validatedData["rating"],
      'media_id' => $validatedData["media_id"],
      'media_type' => $validatedData["media_type"],
    ]);

    // 関連するユーザー情報をロード
    $review->load('user');

    return response()->json($review);

  }


  ///////////////////////////////////////////////////////////////
  // 詳細
  ///////////////////////////////////////////////////////////////
  public function show(Review $review)
  {

    // データベース照会
    $review->load('user', 'comments.user');
    return response()->json($review);

  }


  ///////////////////////////////////////////////////////////////
  // 更新
  ///////////////////////////////////////////////////////////////
  public function update(Request $request, Review $review)
  {

    // バリデーションチェック
    $validatedData = $request->validate([
      'content' => 'required|string',
      'rating' => 'required|integer',
    ]);

    // データベース更新
    $review->update([
      'content' => $validatedData['content'],
      'rating' => $validatedData['rating'],
    ]);
    return response()->json($review);

  }


  ///////////////////////////////////////////////////////////////
  // 削除
  ///////////////////////////////////////////////////////////////
  public function destroy(Review $review)
  {

    // データベース削除
    // $review = Review::find($id);
    // $review->delete();
    $review->delete();
    return response()->json(["message" => "正常にレビューを削除しました。"]);

  }

}
