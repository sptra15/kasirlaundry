<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi'; // Nama tabel
    protected $primaryKey = 'id';   // Kolom primary key, sesuaikan dengan kolom yang ada di tabel
    protected $allowedFields = ['id_transaksi', 'nama_pelanggan', 'tanggal', 'berat', 'harga_per_kg', 'lama_proses', 'total', 'status', 'proses'];// Sesuaikan dengan field yang ada di tabel
}
