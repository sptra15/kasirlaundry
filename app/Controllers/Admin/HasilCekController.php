<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class HasilCekController extends BaseController
{
    public function index()
    {
        $id_transaksi = $this->request->getGet('id_transaksi');

        if (!$id_transaksi) {
            return redirect()->to('/')->with('error', 'ID Transaksi harus diisi.');
        }

        $model = new TransaksiModel();
        $transaksi = $model->where('id_transaksi', $id_transaksi)->first();

        return view('admin/hasil_cek', ['transaksi' => $transaksi, 'id_transaksi' => $id_transaksi]);
    }
}
