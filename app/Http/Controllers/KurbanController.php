<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use PDF;
use App\Models\KurbanHewan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKurbanRequest;
use App\Http\Requests\UpdateKurbanRequest;

class KurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Kurban::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Kurban';
        return view('kurban_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Kurban();
        $data['route'] = 'kurban.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Data Kurban';
        return view('kurban_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tahun_masehi' => 'required',
            'tahun_hijriah' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        Kurban::create($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurban $kurban)
    {
        $data['model'] = $kurban;
        $data['title'] = 'Detail Masjid';
        return view('kurban_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurban $kurban)
    {
        $data['model'] = $kurban;
        $data['route'] = ['kurban.update', $kurban->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Ubah Informasi Kurban';
        return view('kurban_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurban $kurban)
    {
        $requestData = $request->validate([
            'tahun_masehi' => 'required',
            'tahun_hijriah' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        $kurban->update($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurban $kurban)
    {
        $kurban->delete();
        flash('Data sudah dihapus');
        return back();
    }

    public function exportkurbanpdf()
    {
        $data = KurbanHewan::where('id', $id);
        view()->share('data', $data);
        $pdf = PDF::loadview('datakurbanmasjid-pdf');
        return $pdf->download('datakurbanmasjid.pdf');
    }
}
