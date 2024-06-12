<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function create($kosId)
    {
        return view('auth.owner.room', ['kosId' => $kosId]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|max:255',
            'facilities' => 'required|string',
            'description' => 'required|string', // Tambahkan validasi untuk deskripsi
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|integer',
            'available' => 'required|boolean',
            'owner_id' => 'required|integer',
            'kos_id' => 'required|integer',
        ]);

        // Proses unggah gambar
        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->storeAs('images', $imageName, 'public');
        } else {
            $imageName = null;
        }

        $room = new Room();
        $room->room_number = $request->room_number;
        $room->facilities = $request->facilities;
        $room->description = $request->description; // Set deskripsi
        $room->images = $imageName;
        $room->price = $request->price;
        $room->available = $request->available;
        $room->owner_id = $request->owner_id;
        $room->kos_id = $request->kos_id;
        $room->save();

        return redirect()->route('owner.dashboard')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit(Room $room)
{
    return view('auth.owner.room-edit', compact('room'));
}

public function update(Request $request, Room $room)
{
    $request->validate([
        'room_number' => 'required|integer',
        'facilities' => 'required|string',
        'description' => 'required|string',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'price' => 'required|integer',
        'available' => 'required|boolean',
        'owner_id' => 'required|integer',
        'kos_id' => 'required|integer',
    ]);

    // Update room data
    $room->update($request->all());

    return redirect()->route('owner.dashboard')->with('success', 'Room successfully updated.');
}


}
