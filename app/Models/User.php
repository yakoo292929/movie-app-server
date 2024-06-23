<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/app/Models/User.php
 * PROGRAM NAME   : User.php
 *                : Userモデル [usersテーブル]
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

  use HasFactory, Notifiable;

  ///////////////////////////////////////////////////////////////
  // データベース登録許可
  ///////////////////////////////////////////////////////////////
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  ///////////////////////////////////////////////////////////////
  // シリアライズ（転送変換形式）除外 機密対象
  ///////////////////////////////////////////////////////////////
  protected $hidden = [
    'password',
    'remember_token',
  ];

  ///////////////////////////////////////////////////////////////
  // データ型変換
  ///////////////////////////////////////////////////////////////
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  ///////////////////////////////////////////////////////////////
  // リレーション：１ [users] 対 多 [reviews]
  ///////////////////////////////////////////////////////////////
  public function reviews()
  {
    return $this->hasMany(Reviw::class);
  }

  ///////////////////////////////////////////////////////////////
  // リレーション：１ [users] 対 多 [comments]
  ///////////////////////////////////////////////////////////////
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  ///////////////////////////////////////////////////////////////
  // リレーション：１ [users] 対 多 [favorites]
  ///////////////////////////////////////////////////////////////
  public function favorites()
  {
    return $this->hasMany(Favorite::class);
  }

}
