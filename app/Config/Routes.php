<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login routes
$routes->get('login', 'Login\LoginController::index');
$routes->post('login', 'Login\LoginController::authenticate');
$routes->get('logout', 'Login\LoginController::logout');

// Rute untuk pelanggan mengecek transaksi (tidak perlu login)
$routes->get('admin/hasil_cek', 'Admin\HasilCekController::index'); // ✅ Tambahkan ini DI LUAR grup admin

// Grup Admin (dengan filter login admin)
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Transaksi
    $routes->get('transaksi', 'Admin\TransaksiController::index');
    $routes->post('transaksi/simpan', 'Admin\TransaksiController::simpan');
    $routes->get('transaksi/hapus/(:num)', 'Admin\TransaksiController::hapus/$1');
    $routes->post('transaksi/update', 'Admin\TransaksiController::update');
    $routes->get('hasil_cek', 'Admin\TransaksiController::cekStatus');
    $routes->get('transaksi/printStruk/(:segment)', 'Admin\TransaksiController::printStruk/$1');

    // Pelanggan (User)
    $routes->get('user', 'Admin\UserController::index');
    $routes->post('user/simpan', 'Admin\UserController::simpan');
    $routes->post('user/update/(:num)', 'Admin\UserController::update/$1');
    $routes->get('user/hapus/(:num)', 'Admin\UserController::hapus/$1');
    $routes->get('profile/(:segment)', 'Admin\UserController::profile/$1');


    // Report
    $routes->get('report', 'Admin\ReportController::index');
});
