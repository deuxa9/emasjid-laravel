<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Kategori::UserMasjid()->latest()->paginate(50);
        $title = 'Kategori Informasi';
        return view('kategori_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Kategori();
        $data['route'] = 'kategori.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Kategori Informasi';
        return view('kategori_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);
        $requestData['parent_id'] = 0;
        Kategori::create($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data['model'] = $kategori;
        $data['route'] = ['kategori.update', $kategori->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Edit Kategori Informasi';
        return view('kategori_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        $kategori->update($requestData);
        flash('Data sudah diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        flash('Data sudah dihapus');
        return back();
    }

    public function exportkategoriinformasipdf()
    {
        $data = Kategori::where('masjid_id', auth()->user()->masjid_id)->get();
        view()->share('data', $data);
        $pdf = PDF::loadview('datakategoriinformasimasjid-pdf');
        return $pdf->download('datakategoriinformasimasjid.pdf');
    }

    public function exportkategoriinformasiexcel(){
        return Excel::download(new KategoriExport, 'datakategoriinformasimasjid.xlsx');
    }

    public function importkategoriinformasiexcel(Request $request){
    
        $data = $request->file('file');

        $namaFile = $data->getClientOriginalName();
        $data->move('DataKategoriInformasiMasjid', $namaFile);

        Excel::import(new KategoriImport, public_path('/DataKategoriInformasiMasjid/'.$namaFile));
        return back();
    }
}
