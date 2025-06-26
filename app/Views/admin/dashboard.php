<?php echo view('admin/templates/header'); ?>
<?php echo view('admin/templates/sidebar'); ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="p-4 sm:ml-64 mt-6">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <!-- Kartu Transaksi -->
            <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800 p-4">
                <div class="text-center">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <i class="bi bi-cart-check w-6 h-6 mb-2"></i> <!-- Bootstrap Icon for Transaction -->
                    </p>
                    <p class="font-semibold text-lg text-gray-800 dark:text-gray-200">Transaksi</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400"><?= is_array($transaksi) ? count($transaksi) : 0 ?> Transaksi</p>
                </div>
            </div>

            <!-- Kartu Pengguna -->
            <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800 p-4">
                <div class="text-center">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <i class="bi bi-person-fill w-6 h-6 mb-2"></i> <!-- Bootstrap Icon for User -->
                    </p>
                    <p class="font-semibold text-lg text-gray-800 dark:text-gray-200">Pengguna</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400"><?= is_array($users) ? count($users) : 0 ?> Pengguna yang terdaftar</p>
                </div>
            </div>

            <!-- Kartu Laporan -->
            <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800 p-4">
                <div class="text-center">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <i class="bi bi-file-earmark-text w-6 h-6 mb-2"></i> <!-- Bootstrap Icon for Report -->
                    </p>
                    <p class="font-semibold text-lg text-gray-800 dark:text-gray-200">Laporan</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Lihat laporan transaksi</p>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <?php if (empty($transaksi)): ?>
            <p class="text-gray-500 dark:text-gray-400">Tidak ada transaksi untuk ditampilkan.</p>
        <?php else: ?>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID Transaksi</th>
                            <th scope="col" class="px-6 py-3">Pelanggan</th>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $trx): ?>
                            <?php if ($trx['proses'] !== 'Selesai'): ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4"><?= esc($trx['id_transaksi']); ?></td>
                                    <td class="px-6 py-4"><?= esc($trx['nama_pelanggan']); ?></td>
                                    <td class="px-6 py-4"><?= esc($trx['tanggal']); ?></td>
                                    <td class="px-6 py-4"><?= esc($trx['status']); ?></td>
                                    <td class="px-6 py-4">
                                        <a href="<?= base_url('admin/profile/' . $trx['id']) ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>