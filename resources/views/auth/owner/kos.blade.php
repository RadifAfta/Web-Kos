@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">{{ __('Tambah Kos') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('kos.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{ __('Nama Kos') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="address" class="form-label">{{ __('Alamat') }}</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="capacity" class="form-label">{{ __('Kapasitas') }}</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="images" class="form-label">{{ __('Gambar') }}</label>
                                <input type="file" class="form-control" id="images" name="images" accept="image/*">
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">{{ __('Telepon') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="type" class="form-label">{{ __('Tipe') }}</label>
                                <input type="text" class="form-control" id="type" name="type" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">{{ __('Simpan') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
