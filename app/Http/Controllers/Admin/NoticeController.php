<?php

// app/Http/Controllers/Admin/NoticeController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request)
{
    $query = Notice::query();

    if ($search = $request->input('search')) {
        $query->where('title', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%");
    }

    $notices = $query->latest()->paginate(5);

    return view('admin.notices.index', compact('notices'));
}

    // app/Http/Controllers/NoticeController.php


    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required'
        ]);

        Notice::create($request->all());
        return redirect()->route('admin.notices.index')->with('success', 'Notice created successfully!');
    }

    public function edit(Notice $notice)
    {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required'
        ]);

        $notice->update($request->all());
        return redirect()->route('admin.notices.index')->with('success', 'Notice updated successfully!');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return redirect()->route('admin.notices.index')->with('success', 'Notice deleted successfully!');
    }

    public function show(Notice $notice)
{
    return view('admin.notices.show', compact('notice'));
}


    
}
