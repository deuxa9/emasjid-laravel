<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Kas;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Kas6Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\RadialChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        for ($i=1; $i <= $bulan ; $i++) { 
            $totalKas = Kas::userMasjid()->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->sum('jumlah');
            $dataBulan = Carbon::create()->month($i)->format('F');
            $dataTotalKas = $totalKas; 
        }
        
        return $this->chart->radialChart()
            ->setTitle('Data Kas Bulanan')
            ->setSubtitle('Total Penerimaan Kas Bulanan')
            ->addData([$dataTotalKas])
            ->setLabels([$dataBulan])
            ->setColors(['#03A9F4']);
    }
}
