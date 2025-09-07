<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => 'Ali Khan',
            'email' => 'ali@example.com',
            'phone' => '03001234567',
            'room' => 101,
        ]);

        Student::create([
            'name' => 'Sara Ahmed',
            'email' => 'sara@example.com',
            'phone' => '03007654321',
            'room' => 102,
        ]);

        Student::create([
            'name' => 'Usman Iqbal',
            'email' => 'usman@example.com',
            'phone' => '03009876543',
            'room' => 103,
        ]);
    }
}
