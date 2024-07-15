<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('notes', function (Blueprint $table) {
      $table->uuid("id")/* ->primary() */ ;
      $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
      $table->string("title");
      $table->text("body");
      $table->date("send_date");
      $table->boolean("is_published")->default(false);
      $table->integer("heart_count")->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('notes');
  }
};
