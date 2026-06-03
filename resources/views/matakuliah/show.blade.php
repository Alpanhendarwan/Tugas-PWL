@extends('layouts.app')
@section('title', 'Detail Mata Kuliah')
@section('page-title', 'Detail Mata Kuliah')

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card animate-fade-in mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-book me-2"></i>Detail Mata Kuliah</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless">
                    <tr><th width="130">Kode MK</th><td>: <span class="badge bg-primary">{{ $matakuliah->kode_mk }}</span></td></tr>
                    <tr><th>Nama MK</th><td>: {{ $matakuliah->nama_mk }}</td></tr>
                    <tr><th>SKS</th><td>: <span class="badge bg-info">{{ $matakuliah->sks }} SKS</span></td></tr>
                    <tr><th>Semester</th><td>: Semester {{ $matakuliah->semester }}</td></tr>
                </table>
                <a href="{{ route('mata-kuliahs.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card animate-fade-in mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-week me-2"></i>Jadwal</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr><th>Dosen</th><th>Hari</th><th>Jam</th><th>Ruangan</th></tr>
                        </thead>
                        <tbody>
                            @forelse($matakuliah->jadwals as $jadwal)
                            <tr>
                                <td>{{ $jadwal->dosen->nama_dosen }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                <td><span class="badge bg-secondary">{{ $jadwal->ruangan }}</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Belum ada jadwal.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
