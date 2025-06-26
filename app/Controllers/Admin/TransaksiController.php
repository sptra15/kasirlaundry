<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class TransaksiController extends BaseController
{
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
    }

    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $usersModel = new UserModel();

        // Ambil data transaksi beserta id_member yang terhubung dengan users
        $transaksi = $transaksiModel->orderBy('id', 'DESC')->paginate(5, 'default');

        return view('admin/transaksi', [
            'transaksi' => $transaksi,
            'users' => $usersModel->findAll(),
            'pager' => $transaksiModel->pager // digunakan untuk pagination links
        ]);
    }


    public function simpan()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');

        $data = [
            'id_member'      => $this->request->getPost('id_member') ?: null,
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'tanggal'        => $this->request->getPost('tanggal'),
            'berat'          => $this->request->getPost('berat'),
            'harga_per_kg'   => $this->request->getPost('harga_per_kg'),
            'lama_proses'    => $this->request->getPost('lama_proses'),
            'total'          => $this->request->getPost('total'),
            'status'         => $this->request->getPost('status'),
            'proses'         => $this->request->getPost('proses'),
        ];

        if (empty($id_transaksi)) {
            // Tambah
            $data['id_transaksi'] = $this->generateIdTransaksi();
            $this->transaksiModel->insert($data);
        } else {
            // Edit
            $this->transaksiModel
                ->where('id_transaksi', $id_transaksi)
                ->set($data)
                ->update();
        }

        return redirect()->to('/admin/transaksi');
    }

    public function report()
    {
        $model = new TransaksiModel();
        $data['transaksi'] = $model->where('proses', 'Selesai')->findAll();
        return view('admin/report', $data);
    }


    public function hapus($id)
    {
        $this->transaksiModel->delete($id);
        return redirect()->to('/admin/transaksi');
    }

    private function generateIdTransaksi()
    {
        $date = date('Ymd');
        $random = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4)); // 4 karakter acak
        return 'TRX' . $date . $random;
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

    public function printStruk($id_transaksi)
    {
        $model = new TransaksiModel();
        $data['transaksi'] = $model->where('id_transaksi', $id_transaksi)->first();

        if (!$data['transaksi']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/struk', $data); // View struk yang akan dicetak
    }
}
