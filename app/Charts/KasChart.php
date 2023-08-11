<?php

namespace App\Charts;

use App\Models\Kas;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class KasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        for ($i=1; $i <= $bulan ; $i++) { 
            $totalKas = Kas::userMasjid()->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->sum('jumlah');
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalKas[] = $totalKas; 
        }

        return $this->chart->lineChart()
            ->setTitle('Data Kas Bulanan')
            ->setSubtitle('Total Penerimaan Kas Bulanan')
            ->addData('Total Kas '. 'Rp', $dataTotalKas)
            ->setHeight(280)
            ->setLabels($dataBulan);
    }
}
