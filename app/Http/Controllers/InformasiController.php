<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use PDF;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Informasi::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Masjid';
        return view('informasi_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Informasi();
        $data['route'] = 'informasi.store';
        $data['method'] = 'POST';
        $data['listKategori'] = Kategori::pluck('nama', 'id');
        $data['title'] = 'Tambah Profil';
        return view('informasi_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        Informasi::create($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        $data['model'] = $informasi;
        $data['title'] = 'Detail Masjid';
        return view('informasi_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        $data['model'] = $informasi;
        $data['route'] = ['informasi.update', $informasi->id];
        $data['method'] = 'PUT';
        $data['listKategori'] = Kategori::pluck('nama', 'id');
        $data['title'] = 'Ubah Informasi';
        return view('informasi_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);
 
        $informasi->update($requestData);
        flash('Data sudah diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        flash('Data sudah dihapus');
        return back();
    }

    public function exportinfopdf()
    {
        $data = Informasi::where('masjid_id', auth()->user()->masjid_id)->get();
        view()->share('data', $data);
        $pdf = PDF::loadview('datainfomasjid-pdf');
        return $pdf->download('datainfomasjid.pdf');
    }
}
