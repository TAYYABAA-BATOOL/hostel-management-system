<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Student.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'room'];

    // Custom relationship using 'room' field which stores room_no
  public function room()
{
    return $this->belongsTo(Room::class, 'room', 'room_no');
}


    public function payments()
{
    return $this->hasMany(Payment::class);
}





}
