<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Validation\Validator;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $laporans = Report::all();
        return view('pegawai.melihat_progress')->with('laporans', $laporans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pegawai.lapor_kerusakan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        try {
            $input = $request->validate([
                'nama_pegawai' => 'required|min:3',
                'nomor_aset' => 'required',
                'tanggal_pengajuan' => 'required',
                'deskripsi_kerusakan' => 'required',
                'foto' => 'required|image|mimes:jpeg,jpg,png|max:5000'
            ]);
            Report::create(
                array_merge(
                    $input,
                    ['foto' => $request->file('foto')->store('public')]
                    )
                );
                flash('Laporan berhasil disimpan')->success();
                return redirect('pegawai');
            } catch (\Exception $e) {
            flash('Laporan gagal disimpan')->error();
            return redirect('pegawai');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
