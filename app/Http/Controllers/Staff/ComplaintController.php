<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $complaints = Complaint::with('student')
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($search, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhereHas('student', function ($q2) use ($search) {
                          $q2->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString(); // retain filters in pagination

        return view('staff.complaints.index', compact('complaints', 'search', 'status'));
    }

    public function show(Complaint $complaint)
    {
        // Staff view for detailed complaint
        $complaint->load('student');
        return view('staff.complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        $complaint->load('student');
        return view('staff.complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Resolved,Rejected',
            'reply'  => 'nullable|string|max:1000',
        ]);

        $complaint->update([
            'status' => $request->status,
            'reply'  => $request->reply,
        ]);

        return redirect()->route('staff.complaints.show', $complaint)
                         ->with('success', 'Complaint updated successfully.');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('staff.complaints.index')->with('success', 'Complaint deleted.');
    }



}
