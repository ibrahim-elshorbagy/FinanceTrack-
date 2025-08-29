<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('transaction_types')->insert([
      ['id' => 1, 'name' => 'received', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 2, 'name' => 'cash_withdraw', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 3, 'name' => 'withdraw_transfer', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 4, 'name' => 'deposit_transfer', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
