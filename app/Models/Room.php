<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_no', 'type', 'capacity', 'occupied', 'status'];

    public function students()
{
    return $this->hasMany(Student::class, 'room_no', 'room_no');
}




}
