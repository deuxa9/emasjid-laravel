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
        $banks = Bank::count('nama_bank');

        for ($i=1; $i <= $banks ; $i++) { 
            $totalBank = MasjidBank::userMasjid()->count('nama_bank');
            // $dataTotalBank[] = $totalBank; 
            $bank[] = $i;
        }

        return $this->chart->donutChart()
            ->setTitle('Data Bank')
            ->setSubtitle('Total Data Bank')
            ->addData([$totalBank])
            ->setHeight(280)
            ->setLabels($bank);
    }
}
