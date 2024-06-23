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
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      $table->text('content');
      $table->integer('rating')->default(1);
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->bigInteger('media_id');
      $table->string('media_type');
      $table->timestamps();
    });
  }

  ///////////////////////////////////////////////////////////////
  // マイグレーション ロールバック
  ///////////////////////////////////////////////////////////////
  public function down(): void
  {
    Schema::dropIfExists('reviews');
  }
  
};
