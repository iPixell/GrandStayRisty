<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // Admin
    User::create([
      "name" => "Admin",
      "email" => "admin@gmail.com",
      "password" => bcrypt("admin123"),
      "role" => "admin",
    ]);

    // Kamar
    Room::create([
      "name" => "Standard Room",
      "price" => 250000,
    ]);
    Room::create([
      "name" => "Deluxe Room",
      "price" => 450000,
    ]);
    Room::create([
      "name" => "Suite Room",
      "price" => 800000,
    ]);
  }
}
