<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // Get student via logged-in user's email
        $student = Student::where('email', Auth::user()->email)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        $query = Payment::where('student_id', $student->id);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('month')) {
            $query->whereMonth('payment_date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('payment_date', $request->year);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(6);

        // Summary values
        $totalPaid = Payment::where('student_id', $student->id)->where('status', 'Paid')->sum('amount');
        $totalPending = Payment::where('student_id', $student->id)->where('status', 'Pending')->sum('amount');
        $totalDue = Payment::where('student_id', $student->id)->where('status', 'Rejected')->sum('amount');

        return view('student.payments.index', compact('payments', 'totalPaid', 'totalPending', 'totalDue'));
    }

    public function downloadReceipt($id)
    {
        $student = Student::where('email', Auth::user()->email)->first();
        $payment = Payment::findOrFail($id);

        // Security check
        if (!$student || $payment->student_id != $student->id || $payment->status !== 'Paid' || !$payment->receipt) {
            abort(403, 'Unauthorized or receipt not available.');
        }

        return response()->download(storage_path("app/public/receipts/{$payment->receipt}"));
    }
}
