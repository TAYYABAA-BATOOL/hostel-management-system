<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of complaints for logged-in student.
     */
    public function index(Request $request)
    {
        $query = Complaint::where('student_id', Auth::id())->latest();

        // Filter by status if selected
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $complaints = $query->paginate(6);

        return view('student.complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new complaint.
     */
    public function create()
    {
        return view('student.complaints.create');
    }

    /**
     * Store a newly created complaint in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'required|string|min:10',
            'attachment'  => 'nullable|file|max:2048', // max 2MB
        ]);

        $data = [
            'student_id'  => Auth::id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'status'      => 'Pending',
        ];

        // Handle attachment upload
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('complaints', 'public');
        }

        Complaint::create($data);

        return redirect()->route('student.complaints.index')->with('success', 'Complaint submitted successfully!');
    }

    /**
     * Display the specified complaint.
     */
    public function show(Complaint $complaint)
    {
        // Ensure student can only view their own complaint
        if ($complaint->student_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('student.complaints.show', compact('complaint'));
    }

    /**
     * Remove the specified complaint from storage.
     */
    public function destroy(Complaint $complaint)
    {
        if ($complaint->student_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($complaint->status !== 'Pending') {
            return back()->with('error', 'You can only delete complaints that are still pending.');
        }

        // Delete attachment if exists
        if ($complaint->attachment && Storage::disk('public')->exists($complaint->attachment)) {
            Storage::disk('public')->delete($complaint->attachment);
        }

        $complaint->delete();

        return redirect()->route('student.complaints.index')->with('success', 'Complaint deleted successfully.');
    }
}
