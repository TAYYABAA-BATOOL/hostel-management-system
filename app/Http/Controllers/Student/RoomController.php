<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Student;

class RoomController extends Controller
{
    public function index()
    {
        // Get the logged-in user's email
        $userEmail = Auth::user()->email;

        // Find the matching student
        $student = Student::where('email', $userEmail)->first();

        // Check if student exists and has a room assigned
        $room = null;
        if ($student && $student->room) {
            $room = Room::where('room_no', $student->room)->first();
        }

        return view('student.rooms.index', compact('room'));
    }
}
