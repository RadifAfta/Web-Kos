@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Owner Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row">
                            @forelse ($kosList as $kos)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $kos->name }}</h5>
                                            <p class="card-text">{{ $kos->address }}</p>
                                            <h6 class="card-subtitle mb-2 text-muted">Kamar:</h6>
                                            <ul class="list-group">
                                                @forelse ($kos->rooms as $room)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>Nomer Kamar: {{ $room->room_number }}</strong><br>
                                                            <strong>Deskripsi:</strong> {{ $room->description }}<br>
                                                            <strong>Kosong:</strong> {{ $room->available ? 'Tidak' : 'Ya' }}
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('room.edit', $room->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                            <form action="{{ route('dashboard.room.destroy', $room->id) }}', $room->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li class="list-group-item">No rooms available</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <p>No kos available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan tombol tambah kos dan kamar -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <a href="{{ route('kos.create') }}" class="btn btn-primary">Tambah Kos</a>
                <!-- Tambahkan kondisi untuk memeriksa apakah variabel $kos ada -->
                @if(isset($kos))
                    <a href="{{ route('kos.edit', $kos->id) }}" class="btn btn-primary">Edit Kos</a>
                    <a href="{{ route('room.create', ['kosId' => $kos->id ?? null]) }}" class="btn btn-primary">Tambah Kamar</a>
                @endif
                <!-- Tambahkan kondisi untuk memeriksa apakah variabel $room ada -->
            </div>
        </div>
    </div>
@endsection
