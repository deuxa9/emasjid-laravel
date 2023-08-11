<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Infaq;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInfaqRequest;
use App\Http\Requests\UpdateInfaqRequest;
use App\Models\Kas;

class InfaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Infaq::UserMasjid();
        // if ($request->filled('q')) {
        //     $query = $query->where('atas_nama', 'LIKE', '%' . $request->q . '%');
        // }
        // if ($request->filled('tanggal_mulai')) {
        //     $query = $query->whereDate('created_at','>=', $request->tanggal_mulai);
        // }
        // if ($request->filled('tanggal_selesai')) {
        //     $query = $query->whereDate('created_at','<=', $request->tanggal_selesai);
        // }

        $query = $query->latest()->paginate(50);
        return view('infaq_index', compact('query'));
    }

    private function listSumberDana()
    {
        return[
            'kotak-amal-jumat' => 'Kota Amal Jumat',
            'instansi' => 'Instansi',
            'perorang' => 'Perorang',
            'lainnya' => 'Lainnya',
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['query'] = new Infaq();
        $data['listSumberDana'] = $this->listSumberDana();
        return view('infaq_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfaqRequest $request)
    {
        $requestData = $request->validated();
        DB::beginTransaction();
        // $requestData['atas_nama'] = $requestData['atas_nama'] ?? 'Hamba Allah' ;
        $infaq = Infaq::create($requestData);
        if ($infaq->jenis == 'uang') {
            $kas = new Kas();
            $kas->masjid_id = $request->user()->masjid_id;
            $kas->tanggal = $infaq->created_at;
            $kas->kategori = 'infaq-' . $infaq->sumber;
            $kas->jenis = 'masuk';
            $kas->jumlah = $infaq->jumlah;
            $kas->save();
        }
        DB::commit();
        flash('Data Berhasil Ditambahkan')->success();
        return back();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Infaq $infaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infaq $infaq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfaqRequest $request, Infaq $infaq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infaq $infaq)
    {
        //
    }
}
