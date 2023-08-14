<?php

namespace App\Charts;

use App\Models\Bank;
use Carbon\Carbon;
use App\Models\Kas;
use App\Models\MasjidBank;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Kas4Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
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

        return $this->chart->donutChart()
            ->setTitle('Data Kas Bulanan')
            ->setSubtitle('Total Penerimaan Kas Bulanan')
            ->addData($dataMasuk)
            ->setHeight(280)
            ->setLabels($dataBulan);
    }
}
