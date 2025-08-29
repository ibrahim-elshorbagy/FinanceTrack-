<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSourceSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('task_sources')->insert([
      ['id' => 1, 'user_id' => 1, 'name' => 'web jordon', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 2, 'user_id' => 1, 'name' => 'freelance', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 3, 'user_id' => 1, 'name' => 'pxiel digital', 'created_at' => now(), 'updated_at' => now()],
      ['id' => 4, 'user_id' => 1, 'name' => '24motion', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
