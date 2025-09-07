<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Room;
use App\Models\Payment;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    // public function generate(Request $request)
    // {
    //     $type = $request->report_type;
    //     $start = $request->start_date;
    //     $end = $request->end_date;

    //     $data = [];

    //     if ($type === 'students') {
    //         $data = Student::whereBetween('created_at', [$start, $end])->get();
    //     } elseif ($type === 'rooms') {
    //         $data = Room::all();
    //     } elseif ($type === 'payments') {
    //         $data = Payment::whereBetween('payment_date', [$start, $end])->get();
    //     }

    //     return view('admin.reports.show', compact('data', 'type', 'start', 'end'));
    // }
public function generate(Request $request)
{
    $type = $request->report_type;
    $start = $request->start_date;
    $end = $request->end_date;

    $data = [];

    if ($type === 'students') {
    $data = Student::whereDate('created_at', '>=', $start)
                   ->whereDate('created_at', '<=', $end)
                   ->get();


    } elseif ($type === 'rooms') {
        $data = Room::all();
    } elseif ($type === 'payments') {
        $data = Payment::whereBetween('payment_date', [$start, $end])->get();
    }

    // Always provide summary & chart data (even if dummy if not needed)
    $summary = [
        'occupied' => Room::where('status', 'Occupied')->count(),
        'available' => Room::where('status', 'Available')->count(),
        'partial' => Room::where('status', 'Partial')->count()
    ];

    $monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    $monthlyDataset1 = [1200, 1400, 1100, 1500, 1300, 1600];
    $monthlyDataset2 = [1000, 1300, 900, 1200, 1100, 1400];

    return view('admin.reports.show', compact(
        'data', 'type', 'start', 'end',
        'summary', 'monthlyLabels', 'monthlyDataset1', 'monthlyDataset2'
    ));
}

    
    
}
