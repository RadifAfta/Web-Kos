<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $kosList = Kos::with('rooms')->where('owner_id', auth()->id())->get();
        return view('auth.owner.dashboard', compact('kosList'));
    }

    public function destroyRoom(Room $room)
    {
        // Hapus gambar jika ada
        if ($room->images) {
            Storage::delete('public/room_images' . $room->images);
        }

        // Hapus kamar dari database
        $room->delete();

        return redirect()->route('owner.dashboard')->with('success', 'Kamar berhasil dihapus.');
    }
}
