<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('tasks', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->foreignId('task_source_id')->constrained()->cascadeOnDelete();
      // self relation
      $table->foreignId('parent_id')
        ->nullable()
        ->constrained('tasks')
        ->nullOnDelete();
      $table->string('name')->nullable();
      $table->text('note')->nullable();
      $table->decimal('price',  20, 2)->nullable();
      $table->timestamps();
    });


  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tasks');
  }
};
