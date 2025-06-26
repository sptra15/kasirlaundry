<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (session()->get('position') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        $transaksiModel = new TransaksiModel();
        $userModel = new UserModel();

        $data['transaksi'] = $transaksiModel->findAll();
        $data['users'] = $userModel->findAll();

        return view('admin/dashboard', $data);
    }

    public function cekStatus()
    {
        $idTransaksi = $this->request->getGet('id_transaksi');

        $model = new \App\Models\TransaksiModel();
        $transaksi = $model->where('id_transaksi', $idTransaksi)->first();

        return view('transaksi/status_view', [
            'transaksi' => $transaksi,
            'id_transaksi' => $idTransaksi // ✅ ini penting agar bisa dipakai di view
        ]);
    }
}
