<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Kurban;
use App\Models\KurbanHewan;
use Illuminate\Http\Request;
use App\Exports\KurbanExport;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreKurbanHewanRequest;
use App\Http\Requests\UpdateKurbanHewanRequest;

class KurbanHewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kurban = Kurban::userMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $data['model'] = new KurbanHewan();
        $data['route'] = 'kurbanhewan.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Data Hewan Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanhewan_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kurban_id' => [
                'required',
                Rule::exists('kurbans', 'id')->where('masjid_id', auth()->user()->masjid_id)
            ],
            'hewan' => 'required|in:kambing,sapi,domba,kerbau,unta',
            'iuran_perorang' => 'required|numeric',
            'kriteria' => 'nullable',
            'harga' => 'nullable|numeric',
            'biaya_operasional' => 'nullable|numeric',
            'slug' => 'nullable',
        ]);
        KurbanHewan::create($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanHewan $kurbanHewan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanHewan $kurbanhewan)
    {
        $kurban = Kurban::userMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $data['model'] = $kurbanhewan;
        $data['route'] = ['kurbanhewan.update', $kurbanhewan->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Ubah Data Hewan Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanhewan_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KurbanHewan $kurbanhewan)
    {
        $requestData = $request->validate([
            'kurban_id' => [
                'required',
                Rule::exists('kurbans', 'id')->where('masjid_id', auth()->user()->masjid_id)
            ],
            'hewan' => 'required|in:kambing,sapi,domba,kerbau,unta',
            'iuran_perorang' => 'required|numeric',
            'kriteria' => 'nullable',
            'harga' => 'nullable|numeric',
            'biaya_operasional' => 'nullable|numeric',
            'slug' => 'nullable',
        ]);
        $kurbanhewan->update($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanHewan $kurbanhewan)
    {
        $kurbanhewan->delete();
        flash('Data sudah dihapus');
        return back();
    }

    public function exportkurbanpdf()
    {
        $data = KurbanHewan::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datakurbanmasjid-pdf');
        return $pdf->download('datakurbanmasjid.pdf');
    }
    // public function exportkurbanexcel(){
    //     return Excel::download(new KurbanExport, 'datakurbanmasjid.xlsx');
    // }
}
