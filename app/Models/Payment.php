<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount',
        'payment_date',
        'method',
        'status',
        'receipt',
    ];

    protected $dates = ['payment_date'];

    // Relationship with student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

