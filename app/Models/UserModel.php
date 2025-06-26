<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users'; // Nama tabel di database
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_member', 'name', 'email','password','position', 'status']; // Pastikan id_member termasuk di sini
    protected $useTimestamps = true;

    // Jika menggunakan auto increment, pastikan field id otomatis terisi
    protected $useAutoIncrement = true;
    public function verifyAdmin($email, $password)
    {
        // Mencari user berdasarkan username
        $users = $this->where('email', $email)->first();

        if ($users) {
            // Verifikasi password menggunakan password_verify
            if (password_verify($password, $users['password'])) {
                if ($users['position'] === 'admin') {
                    return $users; // Hanya mengembalikan jika role adalah 'admin'
                }
            }
        }

        return null; // Jika tidak ditemukan atau password salah
    }
}
