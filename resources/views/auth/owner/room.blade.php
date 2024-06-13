@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">{{ __('Tambah Kamar') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('room.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="room_number" class="form-label">{{ __('Nomor Kamar') }}</label>
                                <input type="text" class="form-control" id="room_number" name="room_number" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="facilities" class="form-label">{{ __('Fasilitas') }}</label>
                                <textarea class="form-control" id="facilities" name="facilities" rows="3" required></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="images" class="form-label">{{ __('Gambar') }}</label>
                                <input type="file" class="form-control @error('images') is-invalid @enderror" name="images">
                            
                                <!-- error message untuk image -->
                                @error('images')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="price" class="form-label">{{ __('Harga') }}</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="available" class="form-label">{{ __('Tersedia') }}</label>
                                <select class="form-select" id="available" name="available" required>
                                    <option value="1">{{ __('Ya') }}</option>
                                    <option value="0">{{ __('Tidak') }}</option>
                                </select>
                            </div>

                            <input type="hidden" name="owner_id" value="{{ auth()->id() }}">

                            <input type="hidden" name="kos_id" value="{{ $kosId }}">

                            <button type="submit" class="btn btn-primary w-100">{{ __('Simpan') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
