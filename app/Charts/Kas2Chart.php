<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Kas;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Kas2Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        for ($i=1; $i <= $bulan ; $i++) { 
            $totalKas = Kas::userMasjid()->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i)->sum('jumlah');
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalKas[] = $totalKas; 
        }

        return $this->chart->barChart()
            ->setTitle('Data Kas Bulanan')
            ->setSubtitle('Total Penerimaan Kas Bulanan')
            ->addData('Total Kas '.'Rp', $dataTotalKas)
            ->setHeight(280)
            ->setXAxis($dataBulan);
    }
}
