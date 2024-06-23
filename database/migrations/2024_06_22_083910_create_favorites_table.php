<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

  ///////////////////////////////////////////////////////////////
  // マイグレーション 実行
  ///////////////////////////////////////////////////////////////
  public function up(): void
  {
    Schema::create('favorites', function (Blueprint $table) {
      $table->id();
      $table->string('media_type');
      $table->bigInteger('media_id');
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->unique(['media_type', 'media_id', 'user_id']);
      $table->timestamps();
    });
  }

  ///////////////////////////////////////////////////////////////
  // マイグレーション ロールバック
  ///////////////////////////////////////////////////////////////
  public function down(): void
  {
    Schema::dropIfExists('favorites');
  }

};
