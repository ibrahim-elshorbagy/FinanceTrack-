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
    Schema::create('transactions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->foreignId('transaction_type_id')->constrained()->cascadeOnDelete();

      // received, received from any company to certain wallet
      // cash_withdraw   withdraw  from any wallet to my hand
      // withdraw_transfer → "withdrawn *from* wallet A" (negative amount)
      // deposit_transfer → "deposited *into* wallet B" (positive amount)

      $table->foreignId('task_source_id')->nullable()->constrained()->cascadeOnDelete();
      $table->foreignId('wallet_id')->nullable()->constrained()->cascadeOnDelete();
      $table->foreignId('currency_id')->constrained()->cascadeOnDelete();
      $table->decimal('amount', 20, 2)->nullable();
      $table->text('note')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('transactions');
  }
};
