<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'transaksi';
    protected $allowedFields = ['nama_pelanggan', 'tanggal', 'total', 'status', 'proses'];

    public function getLaporanSelesai()
    {
        return $this->where('proses', 'Selesai')->findAll();
    }
}
