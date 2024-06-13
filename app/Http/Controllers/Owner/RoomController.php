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
        return view('auth.owner.updateKamar', compact('room'));
    }

    // public function update(Request $request, Room $room)
    // {
    //     $request->validate([
    //         'room_number' => 'required|integer',
    //         'facilities' => 'required|string',
    //         'description' => 'required|string',
    //         'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'price' => 'required|integer',
    //         'available' => 'required|boolean',
    //         'owner_id' => 'required|integer',
    //         'kos_id' => 'required|integer',
    //     ]);

    //     // Proses unggah gambar
    //     if ($request->hasFile('images')) {
    //         $imageName = time() . '.' . $request->images->extension();
    //         $request->images->storeAs('images', $imageName, 'public');
    //     } else {
    //         $imageName = $room->images;
    //     }

    //     $room->update([
    //         'room_number' => $request->room_number,
    //         'facilities' => $request->facilities,
    //         'description' => $request->description,
    //         'images' => $imageName,
    //         'price' => $request->price,
    //         'available' => $request->available,
    //         'owner_id' => $request->owner_id,
    //         'kos_id' => $request->kos_id,
    //     ]);

    //     return redirect()->route('room.index')->with('success', 'Kamar berhasil diperbarui.');
    // }
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

        if ($request->hasFile('images')) {
            // Hapus gambar lama jika ada
            if ($room->images) {
                // Gunakan Storage untuk menghapus gambar dari penyimpanan
                Storage::delete($room->images);
            }
            // Simpan gambar baru ke penyimpanan
            $room->images = $request->file('images')->store('room_images', 'public');
        }

        // Update atribut-atribut kos lainnya
        $room->room_number = $request->room_number;
        $room->facilities = $request->facilities;
        $room->description = $request->description;
        $room->price = $request->price;
        $room->available = $request->available;
        $room->owner_id = $request->owner_id;
        $room->kos_id = $request->kos_id;

        // Simpan perubahan data room$room
        $room->save();

        return redirect()->route('owner.dashboard')->with('success', 'Kos berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        // Hapus gambar jika ada
        if ($room->images) {
            Storage::delete('public/' . $room->images);
        }

        // Hapus kamar dari database
        $room->delete();

        return redirect()->route('owner.dashboard')->with('success', 'Kamar berhasil dihapus.');
    }

}
