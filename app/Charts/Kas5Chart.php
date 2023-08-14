<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Kas;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Kas5Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $masuk = Kas::where('masjid_id', auth()->user()->masjid_id);
        $keluar = Kas::where('masjid_id', auth()->user()->masjid_id);
        $bulan = date('m');

        for ($i=1; $i <= $bulan ; $i++) { 
            $masuk = Kas::userMasjid()->whereMonth('tanggal', $i)->where('jenis', 'masuk')->sum('jumlah');
            $keluar = Kas::userMasjid()->whereMonth('tanggal', $i)->where('jenis', 'keluar')->sum('jumlah');
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataMasuk[] = $masuk; 
            $dataKeluar[] = $keluar; 
        }
        
        return $this->chart->areaChart()
        ->setTitle('Data Kas Bulanan')
        ->setSubtitle('Total Pemasukan & Pengeluaran')
        ->addData('Pemasukan', $dataMasuk)
        ->addData('Pengeluaran', $dataKeluar)
        ->setHeight(280)
        ->setLabels($dataBulan);
    }
}
