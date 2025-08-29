<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('currencies')->insert([
      ['id' => 1, 'code' => 'EGP', 'name' => 'Egyptian Pound', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 2, 'code' => 'USD', 'name' => 'US Dollar', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 3, 'code' => 'AED', 'name' => 'UAE Dirham', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
