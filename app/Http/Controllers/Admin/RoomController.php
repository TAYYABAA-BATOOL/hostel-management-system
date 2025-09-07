<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
{
    // If search functionality is needed
    $query = Room::query();

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where('room_no', 'like', "%$search%")
              ->orWhere('type', 'like', "%$search%")
              ->orWhere('status', 'like', "%$search%");
    }

    // Paginate results
    $rooms = $query->orderBy('room_no')->paginate(5);

    return view('admin.rooms.index', compact('rooms'));
}


    public function create()
    {
        return view('admin.rooms.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'room_no' => 'required|unique:rooms,room_no',
        'type' => 'required',
        'capacity' => 'required|integer|min:1',
        'occupied' => 'required|integer|min:0',
        'status' => 'required',
    ]);

    Room::create($validated);

    return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully!');
}


    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

 public function update(Request $request, Room $room)
{
    $validated = $request->validate([
        'type' => 'required',
        'capacity' => 'required|integer|min:1',
        'occupied' => 'required|integer|min:0',
        'status' => 'required',
    ]);

    $room->update($validated);

    return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
}

    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('success', 'Room deleted.');
    }
}
