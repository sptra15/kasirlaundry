<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function profile($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User tidak ditemukan");
        }

        // Contoh mengambil transaksi user dari model transaksi (sesuaikan nama model dan kolom)
        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel->where('id', $user['id'])->findAll();

        return view('admin/profile', [
            'user' => $user,
            'transaksi' => $transaksi,
        ]);
    }



    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');

        if ($search) {
            // Tambahkan pencarian berdasarkan 'id_member'
            $data['users'] = $this->userModel
                ->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('id_member', $search)  // Menambahkan pencarian berdasarkan id_member
                ->groupEnd()
                ->findAll();
        } else {
            $users = $this->userModel->findAll();
        }

        // Pastikan variabel $users adalah array yang valid
        if ($users === null) {
            $users = [];  // Jika null, ganti dengan array kosong
        }

        $data['users'] = $users;
        $data['search'] = $search;

        return view('admin/user', $data);
    }


    public function simpan()
    {
        // Validasi termasuk password wajib diisi
        if (!$this->validate([
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'position' => 'required',
            'status'   => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'id_member' => $this->generateIdMember(),
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => $hashedPassword,
            'position'  => $this->request->getPost('position'),
            'status'    => $this->request->getPost('status'),
        ];

        $this->userModel->save($data);

        return redirect()->to('/admin/user')->with('message', 'User berhasil ditambahkan!');
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/user')->with('errors', ['User tidak ditemukan']);
        }

        // Ambil data dari form
        $name     = $this->request->getPost('name');
        $email    = $this->request->getPost('email');
        $position = $this->request->getPost('position');
        $status   = $this->request->getPost('status');
        $password = $this->request->getPost('password');

        // Validasi
        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'position' => 'required',
            'status'   => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data update
        $updateData = [
            'id'       => $id,
            'name'     => $name,
            'email'    => $email,
            'position' => $position,
            'status'   => $status,
        ];

        // Jika password diisi, hash dan simpan
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Simpan ke database
        $this->userModel->save($updateData);

        return redirect()->to('/admin/user')->with('message', 'User berhasil diperbarui!');
    }



    public function hapus($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('message', 'User successfully deleted!');
    }

    private function generateIdMember()
    {
        return 'MBR' . strtoupper(bin2hex(random_bytes(2)));
    }
}
