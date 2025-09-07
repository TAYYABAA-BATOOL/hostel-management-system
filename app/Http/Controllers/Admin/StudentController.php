<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
 public function index(Request $request)
{
    $search = $request->input('search');

    $students = Student::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('room', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    return view('admin.students.index', compact('students', 'search'));
}

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable',
            'room' => 'nullable',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->getKey(),

            'phone' => 'nullable',
            'room' => 'nullable',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student deleted successfully.');
    }

    

}
