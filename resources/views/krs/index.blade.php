@extends('layouts.app')
@section('title', 'Data KRS')
@section('page-title', 'Data KRS')

@section('content')
<div class="card animate-fade-in">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-journal-check me-2"></i>Daftar KRS</h5>
        <a href="{{ route('krs.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Ambil Mata Kuliah</a>
    </div>
    <div class="card-body">
        <form action="{{ route('krs.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="search-box">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" name="search" class="form-control" placeholder="Cari KRS..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                </div>
                @if(request('search'))
                <div class="col-md-2">
                    <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg"></i> Reset</a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Tahun Akademik</th>
                        <th>Semester</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs as $index => $item)
                    <tr>
                        <td>{{ $krs->firstItem() + $index }}</td>
                        <td><span class="badge bg-success">{{ $item->mahasiswa->nim }}</span></td>
                        <td class="fw-medium">{{ $item->mahasiswa->nama_mahasiswa }}</td>
                        <td>{{ $item->mataKuliah->nama_mk }}</td>
                        <td><span class="badge bg-info">{{ $item->mataKuliah->sks }} SKS</span></td>
                        <td>{{ $item->tahun_akademik }}</td>
                        <td>Semester {{ $item->semester }}</td>
                        <td class="text-center">
                            <a href="{{ route('krs.show', $item) }}" class="btn btn-sm btn-info text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('krs.cetak', $item) }}" class="btn btn-sm btn-success" title="Cetak PDF"><i class="bi bi-file-pdf"></i></a>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('krs.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form-{{ $item->id }}')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">Belum ada data KRS.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $krs->links() }}
        </div>
    </div>
</div>
@endsection
