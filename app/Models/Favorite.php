<?php

/**
 * ===========================================================================================
 * SYSTEM NAME    : move-app
 * PROGRAM ID     : server/app/Models/Favorite.php
 * PROGRAM NAME   : Favorite.php
 *                : Favoriteモデル [favoriteテーブル]
 * DEVELOPED BY   : yamabake
 * CREATE DATE    : 2024/06/01
 * CREATE AUTHOR  : yakoo292929
 * ===========================================================================================
**/


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  use HasFactory;

  ///////////////////////////////////////////////////////////////
  // データベース登録許可
  ///////////////////////////////////////////////////////////////
  protected $fillable = [
    'user_id',
    'media_id',
    'media_type'
  ];

}
