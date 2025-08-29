<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory()->create([
      'id' => 1,
      'name' => 'ibrahim elshorbagy',
      'username' => 'a',
      'email' => 'a@a.a',
      'password' => Hash::make('a')
    ]);

    $this->call(CurrencySeeder::class);
    $this->call(TransactionTypeSeeder::class);
    $this->call(TaskSourceSeeder::class);
    $this->call(WalletSeeder::class);

  }
}
