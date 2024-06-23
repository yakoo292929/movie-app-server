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
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->text('content');
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('review_id')->constrained('reviews')->onDelete('cascade');
      $table->timestamps();
    });
  }

  ///////////////////////////////////////////////////////////////
  // マイグレーション ロールバック
  ///////////////////////////////////////////////////////////////
  public function down(): void
  {
    Schema::dropIfExists('comments');
  }

};
