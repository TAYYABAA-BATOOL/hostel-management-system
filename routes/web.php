<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;

use App\Http\Controllers\Staff\StudentController as StaffStudentController;
use App\Http\Controllers\Staff\ComplaintController as StaffComplaintController;

use App\Http\Controllers\Student\ComplaintController as StudentComplaintController;
use App\Http\Controllers\Student\PaymentController as StudentPaymentController;
use App\Http\Controllers\Student\NoticeController as StudentNoticeController;
use App\Http\Controllers\Student\RoomController as StudentRoomController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'staff') {
            return redirect()->route('staff.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    })->name('dashboard');

    // ==================== ADMIN ====================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('students', AdminStudentController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('notices', NoticeController::class);
        
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::post('reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::get('reports/{type}', [ReportController::class, 'show'])->name('reports.show');

        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingsController::class, 'store'])->name('settings.store');
    });

    // ==================== STAFF ====================
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
        Route::get('/students', [StaffStudentController::class, 'index'])->name('students.index');
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
        Route::resource('complaints', StaffComplaintController::class);
    });

    // ==================== STUDENT ====================
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboards.student'); // ya koi controller
        })->name('dashboard');

        Route::get('/room', [StudentRoomController::class, 'index'])->name('room');
        Route::get('/payments', [StudentPaymentController::class, 'index'])->name('payments.index');
        Route::get('/notices', [StudentNoticeController::class, 'index'])->name('notices.index');
        Route::resource('complaints', StudentComplaintController::class)->only(['index', 'create', 'store', 'show']);
    });

    Route::get('/student/payments/{payment}/receipt', [StudentPaymentController::class, 'downloadReceipt'])->name('student.payments.receipt');

});

require __DIR__.'/auth.php';
