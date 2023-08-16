<?php

namespace App\Http\Controllers;

use App\Charts\KasChart;
use App\Charts\Kas2Chart;
use App\Charts\Kas3Chart;
use App\Charts\Kas4Chart;
use App\Charts\Kas5Chart;
use App\Charts\Bank1Chart;
use App\Charts\Bank2Chart;
use App\Charts\Kas6Chart;
use App\Charts\SaldoChart;
use App\Charts\KurbanChart;
use App\Models\Kas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(KasChart $kasChart, Kas2Chart $kas2Chart, 
    Kas3Chart $kas3Chart, Kas4Chart $kas4Chart, Kas5Chart $kas5Chart, Kas6Chart $kas6Chart)
    {
        $data['kas'] = Kas::where('masjid_id', auth()->user()->masjid_id)->latest()->limit(7)->get();
        $data['saldoAkhir'] = Kas::SaldoAkhir();
        $data['masuk'] = Kas::where('masjid_id', auth()->user()->masjid_id)->where('jenis', 'masuk')->sum('jumlah');
        $data['keluar'] = Kas::where('masjid_id', auth()->user()->masjid_id)->where('jenis', 'keluar')->sum('jumlah');
        $data['kasChart'] = $kasChart->build();
        $data['kas2Chart'] = $kas2Chart->build();
        $data['kas3Chart'] = $kas3Chart->build();
        $data['kas4Chart'] = $kas4Chart->build();
        $data['kas5Chart'] = $kas5Chart->build();
        $data['kas6Chart'] = $kas6Chart->build();
        $data['title'] = 'Home';
        return view('home', $data);
    }
}
