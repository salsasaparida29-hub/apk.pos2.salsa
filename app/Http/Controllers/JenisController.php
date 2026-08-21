<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Mengambil data jenis dan mengurutkannya dari yang terbaru
        $jenis = Jenis::latest()->get();

        // 2. Mengarahkan ke file resources/views/jenis/index.blade.php sambil membawa data $jenis
        return view('jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input data wajib diisi
        $request->validate([
            'nama_jenis' => 'required|unique:jenis,nama_jenis',
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi!',
            'nama_jenis.unique' => 'Nama jenis sudah ada!',
        ]);

        // Menyimpan data ke database
        Jenis::create([
            'nama_jenis' => $request->nama_jenis
        ]);

        return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jeni) // PERBAIKAN: Mengubah $jenis menjadi $jeni
    {
        return view('jenis.edit', ['jenis' => $jeni]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis $jeni) // PERBAIKAN: Mengubah $jenis menjadi $jeni
    {
        $request->validate([
            'nama_jenis' => 'required|unique:jenis,nama_jenis,' . $jeni->id,
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi!',
            'nama_jenis.unique' => 'Nama jenis sudah ada!',
        ]);

        $jeni->update([
            'nama_jenis' => $request->nama_jenis
        ]);

        return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jeni) // PERBAIKAN UTAMA: Mengubah $jenis menjadi $jeni
    {
        // Menghapus data dari database
        $jeni->delete();

        return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil dihapus!');
    }
}
