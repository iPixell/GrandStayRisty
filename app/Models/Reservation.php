<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  protected $fillable = [
    "user_id",
    "room_id",
    "check_in",
    "check_out",
    "nights",
    "total",
  ];
  public function room()
  {
    return $this->belongsTo(Room::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
