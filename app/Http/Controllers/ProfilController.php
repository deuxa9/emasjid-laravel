<?php

namespace App\Http\Controllers;

use App\Exports\ProfilExport;
use PDF;
use Str;
use Storage;
use App\Models\Profil;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Imports\ProfilImport;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Profil::UserMasjid()->latest()->paginate(50);
        $title = 'Profil Masjid';
        return view('profil_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['profil'] = new Profil();
        $data['route'] = 'profil.store';
        $data['method'] = 'POST';
        $data['listKategori'] = [
            'visi-misi' => 'Visi Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];
        $data['title'] = 'Tambah Profil';
        return view('profil_form', $data);
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

        Profil::create($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        $data['profil'] = $profil;
        $data['title'] = 'Detail Masjid';
        return view('profil_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profil = Profil::where('masjid_id', auth()->user()->masjid_id)->where('id', $id)->firstOrFail();
        $data['profil'] = $profil;
        $data['route'] = ['profil.update', $profil->id];
        $data['method'] = 'PUT';
        $data['listKategori'] = [
            'visi-misi' => 'Visi Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];
        $data['title'] = 'Ubah Profil';
        return view('profil_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profil)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);
 
        $profil = Profil::findOrFail($profil->id);
        $profil->update($requestData);
        flash('Data sudah diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        $profil->delete();
        flash('Data sudah dihapus');
        return back();
    }

    public function exportprofilpdf()
    {
        $data = Profil::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('dataprofilmasjid-pdf');
        return $pdf->download('dataprofilmasjid.pdf');
    }

    public function exportprofilexcel(){
        return Excel::download(new ProfilExport, 'dataprofilmasjid.xlsx');
    }

    public function importprofilexcel(Request $request){
    
        $data = $request->file('file');

        $namaFile = $data->getClientOriginalName();
        $data->move('DataProfilMasjid', $namaFile);

        Excel::import(new ProfilImport, public_path('/DataProfilMasjid/'.$namaFile));
        return back();
    }
}
