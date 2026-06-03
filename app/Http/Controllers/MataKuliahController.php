<?php
namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Http\Requests\MataKuliahRequest;

class MataKuliahController extends Controller
{
    public function index()
    {
        $search = request('search');
        $matakuliahs = MataKuliah::when($search, function ($query) use ($search) {
            $query->where('nama_mk', 'like', "%{$search}%")
                  ->orWhere('kode_mk', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('matakuliah.index', compact('matakuliahs'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(MataKuliahRequest $request)
    {
        MataKuliah::create($request->validated());
        return redirect()->route('mata-kuliahs.index')->with('success', 'Data mata kuliah berhasil ditambahkan!');
    }

    public function show(MataKuliah $matakuliah)
    {
        $matakuliah->load(['jadwals.dosen', 'krs.mahasiswa']);
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(MataKuliahRequest $request, MataKuliah $matakuliah)
    {
        $matakuliah->update($request->validated());
        return redirect()->route('mata-kuliahs.index')->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('mata-kuliahs.index')->with('success', 'Data mata kuliah berhasil dihapus!');
    }
}
