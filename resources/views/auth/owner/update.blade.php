@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">{{ __('Edit Kos') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('kos.update', $kos->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ __('Nama Kos') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $kos->name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="address" class="form-label">{{ __('Alamat') }}</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $kos->address) }}</textarea>
                            </div>


                            <input type="hidden" name="owner_id" value="{{ old('owner_id', $kos->owner_id) }}">

                            <div class="form-group mb-3">
                                <label for="capacity" class="form-label">{{ __('Kapasitas') }}</label>
                                <input type="number" class="form-control" id="capacity" name="capacity"
                                    value="{{ old('capacity', $kos->capacity) }}" required>
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
                                <label for="phone" class="form-label">{{ __('Nomor Telepon') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $kos->phone) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="type" class="form-label">{{ __('Tipe Kos') }}</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    value="{{ old('type', $kos->type) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $kos->description) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
