<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReportModel;

class ReportController extends BaseController
{
    public function index()
    {
        $model = new ReportModel();
        $transaksi = $model->getLaporanSelesai();

        // Ambil filter dari query string (default: bulanan)
        $filter = $this->request->getGet('filter') ?? 'bulan';

        if ($filter == 'hari') {
            $dataChart = $model->select("DATE(tanggal) as label, SUM(total) as pendapatan")
                               ->where('proses', 'Selesai')
                               ->groupBy("DATE(tanggal)")
                               ->orderBy("DATE(tanggal)", "ASC")
                               ->findAll();
        } elseif ($filter == 'minggu') {
            $dataChart = $model->select("YEARWEEK(tanggal, 1) as label, SUM(total) as pendapatan")
                               ->where('proses', 'Selesai')
                               ->groupBy("YEARWEEK(tanggal, 1)")
                               ->orderBy("YEARWEEK(tanggal, 1)", "ASC")
                               ->findAll();
        } else {
            $dataChart = $model->select("MONTH(tanggal) as label, SUM(total) as pendapatan")
                               ->where('proses', 'Selesai')
                               ->groupBy("MONTH(tanggal)")
                               ->orderBy("MONTH(tanggal)", "ASC")
                               ->findAll();
        }

        $labels = [];
        $pendapatan = [];

        foreach ($dataChart as $row) {
            if ($filter == 'hari') {
                $labels[] = date('d M Y', strtotime($row['label']));
            } elseif ($filter == 'minggu') {
                $labels[] = 'Minggu ke-' . substr($row['label'], 4);
            } else {
                $labels[] = date("F", mktime(0, 0, 0, $row['label'], 1));
            }

            $pendapatan[] = $row['pendapatan'];
        }

        return view('admin/report', [
            'transaksi' => $transaksi,
            'labels' => json_encode($labels),
            'pendapatan' => json_encode($pendapatan),
            'filter' => $filter,
        ]);
    }
}
