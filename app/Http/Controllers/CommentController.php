<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/app/Http/Controllers/CommentController.php
 * PROGRAM NAME   : CommentController.php
 *                : Commentコントローラー
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

  ///////////////////////////////////////////////////////////////
  // 登録
  ///////////////////////////////////////////////////////////////
  public function store(Request $request)
  {

    // バリデーションチェック
    $validatedData = $request->validate([
      'content' => 'required|string|max:200',
      'review_id' => 'required|integer|exists:reviews,id',
    ]);

    // データベース登録
    $comment = Comment::create([
      'content' => $validatedData["content"],
      'review_id' => $validatedData["review_id"],
      'user_id' => Auth::id(),
    ]);

    // 関連するユーザー情報をロード
    $comment->load('user');

    return response()->json($comment);

  }


  ///////////////////////////////////////////////////////////////
  // 更新
  ///////////////////////////////////////////////////////////////
  public function update(Request $request, Comment $comment)
  {

    // 編集できるのは、コメント作成者のみ
    if (Auth::id() !== $comment->user_id) {
        return response()->json(['massage' => '権限がありません。'], 401);
    }

    // バリデーションチェック
    $validatedData = $request->validate([
      'content' => 'required|string|max:200',
    ]);

    // データベース更新
    $comment->update([
      'content' => $validatedData['content'],
    ]);
    return response()->json($comment);

  }

  ///////////////////////////////////////////////////////////////
  // 削除
  ///////////////////////////////////////////////////////////////
  public function destroy(Comment $comment)
  {

    // データベース削除
    // $comment = Review::find($id);
    // $comment->delete();
    $comment->delete();
    return response()->json(["message" => "正常にコメントを削除しました。"]);

  }

}
