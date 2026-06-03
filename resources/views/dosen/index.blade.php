@extends('layouts.app')
@section('title', 'Data Dosen')
@section('page-title', 'Data Dosen')

@section('content')
<div class="card animate-fade-in">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-list me-2"></i>Daftar Dosen</h5>
        <a href="{{ route('dosens.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah Dosen</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dosens as $index => $item)
                    <tr>
                        <td>{{ $dosens->firstItem() + $index }}</td>
                        <td>{{ $item->nidn }}</td>
                        <td>{{ $item->nama_dosen }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">
                            <a href="{{ route('dosens.edit', $item) }}" class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></a>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('dosens.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form-{{ $item->id }}')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">{{ $dosens->links() }}</div>
    </div>
</div>
@endsection
