@extends('layouts.app')
@section('title', 'Data Mata Kuliah')
@section('page-title', 'Data Mata Kuliah')

@section('content')
<div class="card animate-fade-in">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-book me-2"></i>Daftar Mata Kuliah</h5>
        <a href="{{ route('mata-kuliahs.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah Mata Kuliah</a>
    </div>
    <div class="card-body">
        <form action="{{ route('mata-kuliahs.index') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="search-box">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" name="search" class="form-control" placeholder="Cari mata kuliah..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                </div>
                @if(request('search'))
                <div class="col-md-2">
                    <a href="{{ route('mata-kuliahs.index') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-x-lg"></i> Reset</a>
                </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matakuliahs as $index => $mk)
                    <tr>
                        <td>{{ $matakuliahs->firstItem() + $index }}</td>
                        <td><span class="badge bg-primary">{{ $mk->kode_mk }}</span></td>
                        <td class="fw-medium">{{ $mk->nama_mk }}</td>
                        <td><span class="badge bg-info">{{ $mk->sks }} SKS</span></td>
                        <td>Semester {{ $mk->semester }}</td>
                        <td class="text-center">
                            <a href="{{ route('mata-kuliahs.show', $mk) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('mata-kuliahs.edit', $mk) }}" class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></a>
                            <form id="delete-form-{{ $mk->id }}" action="{{ route('mata-kuliahs.destroy', $mk) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form-{{ $mk->id }}')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">Belum ada data mata kuliah.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $matakuliahs->links() }}
        </div>
    </div>
</div>
@endsection
