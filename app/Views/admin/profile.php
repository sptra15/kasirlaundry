<?= view('admin/templates/header'); ?>
<?= view('admin/templates/sidebar'); ?>

<div class="p-4 sm:ml-64 mt-6 max-w-5xl mx-auto">
    <h2 class="text-3xl font-extrabold mb-8 text-gray-900 dark:text-gray-100">Profil Pengguna</h2>

    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg p-8 mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-1">ID Member</h3>
                <p class="text-gray-900 dark:text-gray-100"><?= esc($user['id_member']); ?></p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-1">Nama</h3>
                <p class="text-gray-900 dark:text-gray-100"><?= esc($user['name']); ?></p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-1">Email</h3>
                <p class="text-gray-900 dark:text-gray-100"><?= esc($user['email']); ?></p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-1">Posisi</h3>
                <p class="text-gray-900 dark:text-gray-100"><?= esc($user['position']); ?></p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-1">Status</h3>
                <p class="text-gray-900 dark:text-gray-100"><?= esc($user['status']); ?></p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="<?= base_url('admin/user') ?>"
                class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Kembali ke Daftar Pengguna
            </a>
        </div>
    </div>

    <!-- Daftar Transaksi -->
    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Daftar Transaksi</h3>

        <?php if (empty($transaksi)): ?>
            <p class="text-gray-600 dark:text-gray-400">Belum ada transaksi untuk pengguna ini.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                        <tr>
                            <th class="px-4 py-2">ID Transaksi</th>
                            <th class="px-4 py-2">Tanggal</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Proses</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $trx): ?>
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-2"><?= esc($trx['id_transaksi']); ?></td>
                                <td class="px-4 py-2"><?= esc($trx['tanggal']); ?></td>
                                <td class="px-4 py-2"><?= esc($trx['status']); ?></td>
                                <td class="px-4 py-2"><?= esc($trx['proses']); ?></td>
                                <td class="px-4 py-2">
                                    <a href="<?= base_url('admin/transaksi/view/' . $trx['id_transaksi']) ?>"
                                        class="text-blue-600 hover:underline dark:text-blue-400">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>