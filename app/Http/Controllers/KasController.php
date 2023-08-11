<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Kas;
use App\Exports\KasExport;
use App\Imports\KasImport;
use App\Imports\BankImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kas::UserMasjid();
        if ($request->filled('q')) {
            $query = $query->where('keterangan', 'LIKE', '%' . $request->q . '%');
        }
        if ($request->filled('tanggal_mulai')) {
            $query = $query->whereDate('tanggal','>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query = $query->whereDate('tanggal','<=', $request->tanggal_selesai);
        }

        $kas = $query->latest()->paginate(50);
        $saldoAkhir = Kas::SaldoAkhir();
        $totalPemasukan = $kas->where('jenis', 'masuk')->sum('jumlah');
        $totalPengeluaran = $kas->where('jenis', 'keluar')->sum('jumlah');
        return view('kas_index', [
            'kas' => $kas,
            'title' => 'Kas Masjid',
        ], compact('kas', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran'));
    }

    public function create()
    {
        $kas = new Kas();
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = [];
        $data['title'] = 'Form Transaksi Kas';
        return view('kas_form', compact('kas', 'saldoAkhir', 'disable'));
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
                'tanggal' => 'required|date',
                'kategori' => 'nullable',
                'keterangan' => 'nullable',
                'jenis' => 'required|in:masuk,keluar',
                'jumlah' => 'required',
        ]);

        $tanggalTransaksi = Carbon::parse($requestData['tanggal']);
        // $tahunBulanTransaksi = $tanggalTransaksi->format(('Ym'));
        // $tahunBulanSekarang = Carbon::now()->format('Ym');
        // if ($tahunBulanTransaksi != $tahunBulanSekarang) {
        //     flash('Data Kas gagal ditambahkan. Transaksi hanya bisa dilakukan untuk bulan ini')->error();
        //     return back();
        // }

        $requestData['jumlah'] = str_replace('.', '', $requestData['jumlah']);
        $saldoAkhir = Kas::SaldoAkhir();
        // saldo terakhir + jumlah transaksi masuk
        if($requestData['jenis'] == 'masuk'){
            $saldoAkhir = $saldoAkhir + $requestData['jumlah'];
        }else{
            $saldoAkhir = $saldoAkhir - $requestData['jumlah'];
        }
        
        if ($saldoAkhir <= -1) {
            flash('Data Kas gagal ditambahkan. Saldo Akhir dikurang transaksi tidak boleh kurang dari 0')->error();
            return back();
        }        

        $kas = new Kas();
        $kas->fill($requestData);
        $kas->save();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);

        flash('Data Berhasil Ditambahkan')->success();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan.');
    }

    public function edit(Kas $ka)
    {
        $kas = $ka;
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = ['disabled' => 'disabled'];
        return view('kas_form', compact('kas', 'saldoAkhir', 'disable'));
    }

    public function update(Request $request, Kas $ka)
    {
        $requestData = $request->validate([
            'kategori' => 'nullable',
            'keterangan' => 'nullable',
            'jumlah' => 'required',
        ]);

        $jumlah = str_replace('.', '', $requestData['jumlah']);
        $saldoAkhir = Kas::SaldoAkhir();
        $kas = $ka;
        if ($kas->jenis == 'masuk') {
            $saldoAkhir = $saldoAkhir - $kas->jumlah;
        }
        if ($kas->jenis == 'keluar') {
            $saldoAkhir = $saldoAkhir + $kas->jumlah;
        }
        $saldoAkhir = $saldoAkhir + $jumlah;
        $requestData['jumlah'] = $jumlah;
        $kas->fill($requestData);
        $kas->save();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);
        flash('Data sudah disimpan');
        return redirect()->route('kas.index');
    }

    public function destroy(Kas $ka)
    {
        $kas = $ka;
        $saldoAkhir = Kas::SaldoAkhir();
        if ($kas->jenis == 'masuk') {
            $saldoAkhir = $saldoAkhir - $kas->jumlah;
        }
        if ($kas->jenis == 'keluar') {
            $saldoAkhir = $saldoAkhir + $kas->jumlah;
        }
        $kas->delete();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);
        flash('Data sudah disimpan');
        return redirect()->route('kas.index'); 
    }

    public function exportkaspdf()
    {
        $data = Kas::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datakasmasjid-pdf');
        return $pdf->download('datakasmasjid.pdf');
    }
    public function exportkasexcel()
    {
        return Excel::download(new KasExport, 'datakasmasjid.xlsx');
    }

    // public function importkasexcel(Request $request){
        
    //     $data = $request->file('file');

    //     $namaFile = $data->getClientOriginalName();
    //     $data->move('DataKasMasjid', $namaFile);

    //     Excel::import(new KasImport, public_path('/DataKasMasjid/'.$namaFile));
    //     return back();
    // }
}
