@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="fw-bold">Selamat Datang, {{ Auth::user()->name }}! 👋</h4>
        <p class="text-muted">Berikut ringkasan data akademik terkini.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4 col-lg animate-fade-in">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <div class="stat-icon"><i class="bi bi-person-badge"></i></div>
            <div class="stat-label">Total Dosen</div>
            <div class="stat-number">{{ $totalDosen }}</div>
            <a href="{{ route('dosens.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem;"><i class="bi bi-arrow-right"></i> Lihat Detail</a>
        </div>
    </div>
    <div class="col-md-4 col-lg animate-fade-in">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-number">{{ $totalMahasiswa }}</div>
            <a href="{{ route('mahasiswas.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem;"><i class="bi bi-arrow-right"></i> Lihat Detail</a>
        </div>
    </div>
    <div class="col-md-4 col-lg animate-fade-in">
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
            <div class="stat-icon"><i class="bi bi-book"></i></div>
            <div class="stat-label">Total Mata Kuliah</div>
            <div class="stat-number">{{ $totalMataKuliah }}</div>
            <a href="{{ route('mata-kuliahs.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem;"><i class="bi bi-arrow-right"></i> Lihat Detail</a>
        </div>
    </div>
    <div class="col-md-4 col-lg animate-fade-in">
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
            <div class="stat-icon"><i class="bi bi-calendar-week"></i></div>
            <div class="stat-label">Total Jadwal</div>
            <div class="stat-number">{{ $totalJadwal }}</div>
            <a href="{{ route('jadwals.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem;"><i class="bi bi-arrow-right"></i> Lihat Detail</a>
        </div>
    </div>
    <div class="col-md-4 col-lg animate-fade-in">
        <div class="stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
            <div class="stat-icon"><i class="bi bi-journal-check"></i></div>
            <div class="stat-label">Total KRS</div>
            <div class="stat-number">{{ $totalKrs }}</div>
            <a href="{{ route('krs.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem;"><i class="bi bi-arrow-right"></i> Lihat Detail</a>
        </div>
    </div>
</div>
@endsection
