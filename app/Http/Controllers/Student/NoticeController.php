<?php



namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->paginate(6); // ya jitne chaho

        

        return view('student.notices.index', compact('notices'));
    }
}

