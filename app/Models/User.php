<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    


    public function isAdmin()  { return $this->role === 'admin'; }
    public function isStaff()  { return $this->role === 'staff'; }
    public function isStudent(){ return $this->role === 'student'; }
    protected $casts = [
    'email_verified_at' => 'datetime',
    'role' => 'string',

    
];

// app/Models/User.php

public function student()
{
    return $this->hasOne(Student::class, 'email', 'email'); // assuming email is shared
}

public function payments()
{
    return $this->hasMany(\App\Models\Payment::class, 'student_id');
}

public function complaints()
{
    return $this->hasMany(Complaint::class, 'student_id');
}



}


