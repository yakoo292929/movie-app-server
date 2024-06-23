<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/app/Models/Review.php
 * PROGRAM NAME   : Review.php
 *                : Reviewモデル [reviewsテーブル]
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

  use HasFactory;

  ///////////////////////////////////////////////////////////////
  // データベース登録許可
  ///////////////////////////////////////////////////////////////
  protected $fillable = [
    'content',
    'rating',
    'user_id',
    'media_id',
    'media_type'
  ];

  ///////////////////////////////////////////////////////////////
  // リレーション：多 [reviews] 対 １ [users]
  ///////////////////////////////////////////////////////////////
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  ///////////////////////////////////////////////////////////////
  // リレーション：１ [reviews] 対 多 [comments]
  ///////////////////////////////////////////////////////////////
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

}
