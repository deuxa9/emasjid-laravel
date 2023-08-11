<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Bank;
use App\Imports\KasImport;
use App\Models\MasjidBank;
use App\Exports\BankExport;
use App\Imports\BankImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreMasjidBankRequest;
use App\Http\Requests\UpdateMasjidBankRequest;

class MasjidBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = MasjidBank::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Bank Masjid';
        return view('masjidbank_index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new MasjidBank();
        $data['route'] = 'masjidbank.store';
        $data['method'] = 'POST';
        $data['listBank'] = Bank::pluck('nama_bank', 'id');
        $data['title'] = 'Tambah Bank Baru';
        return view('masjidbank_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
        ]);
        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;
        MasjidBank::create($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(MasjidBank $masjidBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasjidBank $masjidbank)
    {
        $data['model'] = $masjidbank;
        $data['route'] = ['masjidbank.update', $masjidbank->id];
        $data['method'] = 'PUT';
        $data['listBank'] = Bank::pluck('nama_bank', 'id');
        $data['title'] = 'Ubah Bank';
        return view('masjidbank_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasjidBank $masjidbank)
    {
        $requestData = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
        ]);
        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;
        $masjidbank->update($requestData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasjidBank $masjidbank)
    {
        $masjidbank->delete();
        flash('Data sudah dihapus');
        return back();
    }

    public function exportbankpdf()
    {
        $data = MasjidBank::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('databankmasjid-pdf');
        return $pdf->download('databankmasjid.pdf');
    }
    
    public function exportbankexcel(){
        return Excel::download(new BankExport, 'databankmasjid.xlsx');
    }

    public function importbankexcel(Request $request){
    
        $data = $request->file('file');

        $namaFile = $data->getClientOriginalName();
        $data->move('DataBankMasjid', $namaFile);

        Excel::import(new BankImport, public_path('/DataBankMasjid/'.$namaFile));
        return back();
    }
}
