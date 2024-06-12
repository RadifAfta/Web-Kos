@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">{{ __('Edit Kamar') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('room.update', $room->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="room_number" class="form-label">{{ __('Nomor Kamar') }}</label>
                                <input type="text" class="form-control" id="room_number" name="room_number"
                                    value="{{ old('room_number', $room->room_number) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="facilities" class="form-label">{{ __('Fasilitas') }}</label>
                                <textarea class="form-control" id="facilities" name="facilities" rows="3" required>{{ old('facilities', $room->facilities) }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $room->description) }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="images" class="form-label">{{ __('Gambar') }}</label>
                                <input type="file" class="form-control" id="images" name="images" accept="image/*">
                            </div>

                            <div class="form-group mb-3">
                                <label for="price" class="form-label">{{ __('Harga') }}</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ old('price', $room->price) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="available" class="form-label">{{ __('Tersedia') }}</label>
                                <select class="form-select" id="available" name="available" required>
                                    <option value="1" {{ old('available', $room->available) == 1 ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="0" {{ old('available', $room->available) == 0 ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>
                            </div>

                            <!-- Hidden field for owner_id -->
                            <input type="hidden" name="owner_id" value="{{ old('owner_id', $room->owner_id) }}">

                            <!-- Hidden field for kos_id -->
                            <input type="hidden" name="kos_id" value="{{ old('kos_id', $room->kos_id) }}">

                            <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div
