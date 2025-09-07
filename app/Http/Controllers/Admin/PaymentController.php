<?php

// app/Http/Controllers/Admin/PaymentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
public function index(Request $request)
{
    $query = Payment::with('student');

    if ($request->has('search') && $request->search) {
        $searchTerm = $request->search;

        $query->whereHas('student', function ($q) use ($searchTerm) {
            $q->where('name', 'like', "%{$searchTerm}%")
              ->orWhere('email', 'like', "%{$searchTerm}%")
              ->orWhere('phone', 'like', "%{$searchTerm}%");
        })
        ->orWhere('payment_method', 'like', "%{$searchTerm}%")
        ->orWhere('status', 'like', "%{$searchTerm}%");
    }

    $payments = $query->latest()->paginate(5);
    $totalIncome = $query->sum('amount');

    return view('admin.payments.index', compact('payments', 'totalIncome'));
}


    public function create()
    {
        $students = Student::all();
        return view('admin.payments.create', compact('students'));
    }

 public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'amount' => 'required|numeric|min:0',
        'payment_date' => 'required|date',
        'method' => 'required|string',
        'status' => 'required|in:Paid,Pending',
    ]);

    Payment::create([
        'student_id' => $request->student_id,
        'amount' => $request->amount,
        'payment_date' => $request->payment_date,
        'method' => $request->method,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.payments.index')->with('success', 'Payment added successfully!');
}


    public function edit(Payment $payment)
    {
        $students = Student::all();
        return view('admin.payments.edit', compact('payment', 'students'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'method' => 'required|in:Cash,Card,Bank Transfer,Other',
            'note' => 'nullable',
        ]);

        $payment->update($validated);
        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted.');
    }


    

    
}


