@extends('layouts.app')
@section('title', 'Data Jadwal')
@section('page-title', 'Data Jadwal')

@section('content')
<div class="card animate-fade-in">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-week me-2"></i>Daftar Jadwal</h5>
        <a href="{{ route('jadwals.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah Jadwal</a>
    </div>
    <div class="card-body">
        <form action="{{ route('jadwals.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="search-box">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" name="search" class="form-control" placeholder="Cari jadwal..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                </div>
                @if(request('search'))
                <div class="col-md-2">
                    <a href="{{ route('jadwals.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg"></i> Reset</a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $index => $jadwal)
                    <tr>
                        <td>{{ $jadwals->firstItem() + $index }}</td>
                        <td class="fw-medium">{{ $jadwal->mataKuliah->nama_mk }}</td>
                        <td>{{ $jadwal->dosen->nama_dosen }}</td>
                        <td><span class="badge bg-success">{{ $jadwal->hari }}</span></td>
                        <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        <td><span class="badge bg-secondary">{{ $jadwal->ruangan }}</span></td>
                        <td class="text-center">
                            <a href="{{ route('jadwals.show', $jadwal) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('jadwals.edit', $jadwal) }}" class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></a>
                            <form id="delete-form-{{ $jadwal->id }}" action="{{ route('jadwals.destroy', $jadwal) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form-{{ $jadwal->id }}')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">Belum ada data jadwal.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $jadwals->links() }}
        </div>
    </div>
</div>
@endsection
