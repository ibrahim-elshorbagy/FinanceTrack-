<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('wallets')->insert([
      ['id' => 1, 'user_id' => 1, 'name' => 'Vodafone Cash', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 2, 'user_id' => 1, 'name' => 'PayPal', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 3, 'user_id' => 1, 'name' => 'EasyPay', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 4, 'user_id' => 1, 'name' => 'Bank Misr Debit', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
