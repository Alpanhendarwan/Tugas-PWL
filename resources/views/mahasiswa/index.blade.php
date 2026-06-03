@extends('layouts.app')
@section('title', 'Data Mahasiswa')
@section('page-title', 'Data Mahasiswa')

@section('content')
<div class="card animate-fade-in">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-list me-2"></i>Daftar Mahasiswa</h5>
        <a href="{{ route('mahasiswas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $index => $item)
                    <tr>
                        <td>{{ $mahasiswas->firstItem() + $index }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->nama_mahasiswa }}</td>
                        <td>{{ $item->prodi }}</td>
                        <td>{{ $item->semester }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">
                            <a href="{{ route('mahasiswas.edit', $item) }}" class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></a>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('mahasiswas.destroy', $item) }}" method="POST" class="d-inline">
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
        <div class="d-flex justify-content-end">{{ $mahasiswas->links() }}</div>
    </div>
</div>
@endsection
