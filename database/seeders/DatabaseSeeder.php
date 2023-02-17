<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(30)->create();
    DB::table('users')->insert([
      'name' => 'Ishmael',
      'email' => 'ishmael@deveint.com',
      'password' => '$2y$10$y5KwRinBAUzQsBuK6EvRXuu0i2RrjTHGs00SOD44S1L9VCMgvx3I6',
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }
}
