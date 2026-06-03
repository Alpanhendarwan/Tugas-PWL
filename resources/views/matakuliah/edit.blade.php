@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')
@section('page-title', 'Edit Mata Kuliah')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card animate-fade-in">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Mata Kuliah</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('mata-kuliahs.update', $matakuliah) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode MK <span class="text-danger">*</span></label>
                            <input type="text" name="kode_mk" class="form-control @error('kode_mk') is-invalid @enderror" value="{{ old('kode_mk', $matakuliah->kode_mk) }}">
                            @error('kode_mk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                            <input type="text" name="nama_mk" class="form-control @error('nama_mk') is-invalid @enderror" value="{{ old('nama_mk', $matakuliah->nama_mk) }}">
                            @error('nama_mk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKS <span class="text-danger">*</span></label>
                            <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks', $matakuliah->sks) }}" min="1" max="6">
                            @error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Semester <span class="text-danger">*</span></label>
                            <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester', $matakuliah->semester) }}" min="1" max="14">
                            @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
                        <a href="{{ route('mata-kuliahs.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
