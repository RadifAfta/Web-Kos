<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kos;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    public function create()
    {
        return view('auth.owner.kos');
    }

    public function store(Request $request)
    {
        // Validasi data form tambah kos
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|string|max:15',
            'type' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        // Proses unggah gambar
        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension();
            $request->images->storeAs('images', $imageName, 'public');
        } else {
            $imageName = null;
        }

        // Simpan data kos ke dalam database
        Kos::create([
            'name' => $request->name,
            'address' => $request->address,
            'capacity' => $request->capacity,
            'images' => $imageName,
            'phone' => $request->phone,
            'type' => $request->type,
            'description' => $request->description,
            'owner_id' => auth()->id(),
        ]);

        // Redirect ke halaman dashboard atau halaman lainnya
        return redirect()->route('owner.dashboard')->with('success', 'Kos berhasil ditambahkan');
    }

    public function edit(Kos $kos)
    {
        return view('auth.owner.update', compact('kos'));
    }

    public function update(Request $request, Kos $kos)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'owner_id' => 'required|integer',
            'capacity' => 'required|integer',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        if ($request->hasFile('images')) {
            // Hapus gambar lama jika ada
            if ($kos->images) {
                // Gunakan Storage untuk menghapus gambar dari penyimpanan
                Storage::delete($kos->images);
            }
            // Simpan gambar baru ke penyimpanan
            $kos->images = $request->file('images')->store('kos_images', 'public');
        }
    
        // Update atribut-atribut kos lainnya
        $kos->name = $request->name;
        $kos->address = $request->address;
        $kos->owner_id = $request->owner_id;
        $kos->capacity = $request->capacity;
        $kos->phone = $request->phone;
        $kos->type = $request->type;
        $kos->description = $request->description;
    
        // Simpan perubahan data kos
        $kos->save();

        return redirect()->route('owner.dashboard')->with('success', 'Kos berhasil diperbarui.');
    }

}
