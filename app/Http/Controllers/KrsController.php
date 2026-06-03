<?php
namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Http\Requests\KrsRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    public function index()
    {
        $search = request('search');
        $krs = Krs::with(['mahasiswa', 'mataKuliah'])
            ->when($search, function ($query) use ($search) {
                $query->where('tahun_akademik', 'like', "%{$search}%")
                      ->orWhereHas('mahasiswa', function ($q) use ($search) {
                          $q->where('nama_mahasiswa', 'like', "%{$search}%")
                            ->orWhere('nim', 'like', "%{$search}%");
                      })
                      ->orWhereHas('mataKuliah', function ($q) use ($search) {
                          $q->where('nama_mk', 'like', "%{$search}%");
                      });
            })->latest()->paginate(10)->withQueryString();

        return view('krs.index', compact('krs'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::orderBy('nama_mahasiswa')->get();
        $matakuliahs = MataKuliah::orderBy('nama_mk')->get();
        return view('krs.create', compact('mahasiswas', 'matakuliahs'));
    }

    public function store(KrsRequest $request)
    {
        // Check duplicate
        $exists = Krs::where('mahasiswa_id', $request->mahasiswa_id)
            ->where('mata_kuliah_id', $request->mata_kuliah_id)
            ->where('tahun_akademik', $request->tahun_akademik)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Mata kuliah sudah diambil pada tahun akademik ini!');
        }

        Krs::create($request->validated());
        return redirect()->route('krs.index')->with('success', 'KRS berhasil ditambahkan!');
    }

    public function show(Krs $kr)
    {
        $kr->load(['mahasiswa', 'mataKuliah']);

        // Get all KRS for the same mahasiswa and tahun_akademik
        $allKrs = Krs::with('mataKuliah')
            ->where('mahasiswa_id', $kr->mahasiswa_id)
            ->where('tahun_akademik', $kr->tahun_akademik)
            ->get();

        $totalSks = $allKrs->sum(function ($item) {
            return $item->mataKuliah->sks;
        });

        return view('krs.show', compact('kr', 'allKrs', 'totalSks'));
    }

    public function destroy(Krs $kr)
    {
        $kr->delete();
        return redirect()->route('krs.index')->with('success', 'KRS berhasil dihapus!');
    }

    public function cetak(Krs $kr)
    {
        $kr->load(['mahasiswa', 'mataKuliah']);

        $allKrs = Krs::with('mataKuliah')
            ->where('mahasiswa_id', $kr->mahasiswa_id)
            ->where('tahun_akademik', $kr->tahun_akademik)
            ->get();

        $totalSks = $allKrs->sum(function ($item) {
            return $item->mataKuliah->sks;
        });

        $pdf = Pdf::loadView('krs.pdf', compact('kr', 'allKrs', 'totalSks'));
        return $pdf->download('krs-' . $kr->mahasiswa->nim . '-' . $kr->tahun_akademik . '.pdf');
    }
}
