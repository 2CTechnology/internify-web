<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\TempatMagang;
use App\Models\PlotingDosen;
use App\Models\Assignment;
use App\Models\AlurMagang;

class AssignmentController extends Controller
{
public function create($id)
{
    $ploting = PlotingDosen::findOrFail($id);

    $kelompoks = Kelompok::whereHas('alurMagang', function($query) {
        $query->where('surat_pelaksanaan', '!=', null);
    })->get();

    $tempatMagangs = TempatMagang::all();

    return view('assignments.create', compact('ploting', 'kelompoks', 'tempatMagangs'));
}


    public function store(Request $request)
    {
        $request->validate([
            'id_kelompok' => 'required|exists:kelompoks,id',
            'id_tempat_magang' => 'required|exists:tempat_magangs,id',
            'id_ploting_dosen' => 'required|exists:ploting_dosens,id',
            'tahun' => 'required|digits:4',
        ]);

        Assignment::create([
            'id_kelompok' => $request->id_kelompok,
            'id_tempat_magang' => $request->id_tempat_magang,
            'id_ploting_dosen' => $request->id_ploting_dosen,
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
        ]);

        // Update jumlah kelompok pada ploting dosen
        $ploting = PlotingDosen::find($request->id_ploting_dosen);
        $ploting->decrement('jumlah_kelompok');

        // Opsional: update id_dospem di tabel kelompok
        $kelompok = Kelompok::find($request->id_kelompok);
        $kelompok->id_dospem = $ploting->id_dosen;
        $kelompok->save();

        return redirect()->back()->with('success', 'Dosen berhasil di-assign ke kelompok.');
    }
}
