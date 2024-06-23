<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/app/Models/Comment.php
 * PROGRAM NAME   : Comment.php
 *                : Commentモデル [commentsテーブル]
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  use HasFactory;

  ///////////////////////////////////////////////////////////////
  // データベース登録許可
  ///////////////////////////////////////////////////////////////
  protected $fillable = [
    'content',
    'review_id',
    'user_id',
  ];

  ///////////////////////////////////////////////////////////////
  // リレーション：多 [comments] 対 １ [users]
  ///////////////////////////////////////////////////////////////
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  ///////////////////////////////////////////////////////////////
  // リレーション：多 [comments] 対 １ [reviews]
  ///////////////////////////////////////////////////////////////
  public function review()
  {
    return $this->belongsTo(Review::class);
  }

}
