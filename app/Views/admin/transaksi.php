<?php echo view('admin/templates/header'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Layout utama: sidebar dan konten -->
<div class="flex">
    <!-- Sidebar -->
    <div class="w-64">
        <?php echo view('admin/templates/sidebar'); ?>
    </div>

    <!-- Konten -->
    <div class="content p-6 flex-1 bg-gray-50">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Data Transaksi</h1>

        <!-- Filter ID Transaksi -->
        <div class="flex items-center justify-between mb-6">
            <div class="relative w-full max-w-sm">
                <input
                    type="text"
                    id="cariIdTransaksi"
                    placeholder="Cari ID Transaksi..."
                    onkeyup="filterTransaksi()"
                    class="pl-10 pr-4 py-2.5 text-sm border border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 4a7 7 0 107 7 7 7 0 00-7-7zM3 11l2 2m0 0l-2 2m2-2h18" />
                </svg>
            </div>

            <button onclick="openModal('tambah')" class="ml-4 px-4 py-2.5 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition duration-300 shadow">
                + Tambah Transaksi
            </button>
        </div>
        <!-- Tabel Data Transaksi -->
        <div class="overflow-x-auto rounded-xl shadow-md bg-white max-w-full">
            <table class="min-w-max divide-y divide-gray-200 text-xs">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold whitespace-nowrap">No</th>
                        <th class="px-4 py-2 text-left font-semibold whitespace-nowrap">ID Transaksi</th>
                        <th class="px-4 py-2 text-left font-semibold whitespace-nowrap">Pelanggan</th>
                        <th class="px-4 py-2 text-left font-semibold whitespace-nowrap">Tanggal</th>
                        <th class="px-4 py-2 text-right font-semibold whitespace-nowrap">Total</th>
                        <th class="px-4 py-2 text-center font-semibold whitespace-nowrap">Status</th>
                        <th class="px-4 py-2 text-center font-semibold whitespace-nowrap">Proses</th>
                        <th class="px-4 py-2 text-center font-semibold whitespace-nowrap">Profile</th>
                        <th class="px-4 py-2 text-center font-semibold whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-800">
                    <?php $no = 1; ?>
                    <?php foreach ($transaksi as $trx): ?>
                        <?php if ($trx['proses'] !== 'Selesai'): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-2 whitespace-nowrap"><?= $no++ ?></td>
                                <td class="px-4 py-2 whitespace-nowrap"><?= esc($trx['id_transaksi']) ?></td>
                                <td class="px-4 py-2 whitespace-nowrap"><?= esc($trx['nama_pelanggan']) ?></td>
                                <td class="px-4 py-2 whitespace-nowrap"><?= esc($trx['tanggal']) ?></td>
                                <td class="px-4 py-2 text-right whitespace-nowrap">Rp<?= number_format($trx['total'], 0, ',', '.') ?></td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">
                                    <span class="font-semibold <?= $trx['status'] === 'Belum Dibayar' ? 'text-red-600' : ($trx['status'] === 'Sudah Dibayar' ? 'text-green-600' : '') ?>">
                                        <?= esc($trx['status']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">
                                    <span class="font-semibold <?=
                                                                $trx['proses'] === 'Sedang Diproses' ? 'text-yellow-500' : ($trx['proses'] === 'Sudah Diproses' || $trx['proses'] === 'Selesai' ? 'text-green-600' : '')
                                                                ?>">
                                        <?= esc($trx['proses']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">
                                    <?= !empty($trx['id_member']) ? 'Member' : 'Bukan Member' ?>
                                </td>
                                <td class="px-4 py-2 text-center whitespace-nowrap space-x-2">
                                    <button onclick='editModal(<?= json_encode($trx) ?>)' class="text-blue-600 hover:underline">Edit</button>
                                    <a href="<?= base_url('admin/transaksi/hapus/' . $trx['id']) ?>" onclick="return confirm('Hapus transaksi ini?')" class="text-red-600 hover:underline">Hapus</a>
                                    <a href="<?= base_url('admin/transaksi/printStruk/' . $trx['id_transaksi']) ?>" target="_blank" class="text-green-600 hover:underline">Cetak</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- pagination -->
            <div class="mt-4">
                <?= $pager->links('default', 'tailwind_pagination') ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Transaksi -->
<div id="transaksiModalTambah" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70 transition-opacity duration-300">
    <div class="relative w-full max-w-lg mx-auto bg-white rounded-2xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300 p-6" id="modalContentTambah">
        <button onclick="closeModal('tambah')" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl font-bold">&times;</button>
        <h2 id="modalTitleTambah" class="text-2xl font-bold text-gray-800 mb-6 text-center flex items-center justify-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Transaksi
        </h2>
        <form action="<?= base_url('admin/transaksi/simpan') ?>" method="post" class="space-y-4">
            <input type="hidden" name="id" id="idTambah">
            <div>
                <label for="id_member" class="block text-sm font-medium text-gray-700">ID Member</label>
                <input type="text" name="id_member" id="id_memberTambah" oninput="cekMember()" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan ID Member" />
            </div>
            <div>
                <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelangganTambah" required class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggalTambah" required class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="lama_proses" class="block text-sm font-medium text-gray-700">Lama Proses (hari)</label>
                    <input type="number" name="lama_proses" id="lama_prosesTambah" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="berat" class="block text-sm font-medium text-gray-700">Berat (kg)</label>
                    <input type="number" name="berat" id="beratTambah" step="0.1" oninput="hitungTotalTambah()" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="harga_per_kg" class="block text-sm font-medium text-gray-700">Harga per kg</label>
                    <input type="number" name="harga_per_kg" id="harga_per_kgTambah" step="1000" oninput="hitungTotalTambah()" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                    <input type="number" name="total" id="totalTambah" readonly class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="statusTambah" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Belum Dibayar">Belum Dibayar</option>
                        <option value="Sudah Dibayar">Sudah Dibayar</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="proses" class="block text-sm font-medium text-gray-700">Proses</label>
                    <select name="proses" id="prosesTambah" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Sedang Diproses">Sedang Diproses</option>
                        <option value="Sudah Diproses">Sudah Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" onclick="closeModal('tambah')" class="bg-gray-500 text-white rounded-lg px-6 py-3">Batal</button>
                <button type="submit" class="bg-blue-600 text-white rounded-lg px-6 py-3">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Transaksi -->
<div id="transaksiModalEdit" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-70 transition-opacity duration-300">
    <div class="relative w-full max-w-lg mx-auto bg-white rounded-2xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300 p-6" id="modalContentEdit">
        <button onclick="closeModal('edit')" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl font-bold">&times;</button>
        <h2 id="modalTitleEdit" class="text-2xl font-bold text-gray-800 mb-6 text-center flex items-center justify-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Edit Transaksi
        </h2>
        <form action="<?= base_url('admin/transaksi/simpan') ?>" method="post" class="space-y-4">
            <input type="hidden" name="id_transaksi" id="idEdit">
            <div>
                <label for="id_member" class="block text-sm font-medium text-gray-700">ID Member</label>
                <input type="text" name="id_member" id="id_memberEdit" readonly class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelangganEdit" required class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggalEdit" required class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="lama_proses" class="block text-sm font-medium text-gray-700">Lama Proses (hari)</label>
                    <input type="number" name="lama_proses" id="lama_prosesEdit" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="berat" class="block text-sm font-medium text-gray-700">Berat (kg)</label>
                    <input type="number" name="berat" id="beratEdit" step="0.1" oninput="hitungTotalEdit()" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="harga_per_kg" class="block text-sm font-medium text-gray-700">Harga per kg</label>
                    <input type="number" name="harga_per_kg" id="harga_per_kgEdit" step="1000" oninput="hitungTotalEdit()" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                    <input type="number" name="total" id="totalEdit" readonly class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="statusEdit" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Belum Dibayar">Belum Dibayar</option>
                        <option value="Sudah Dibayar">Sudah Dibayar</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="proses" class="block text-sm font-medium text-gray-700">Proses</label>
                    <select name="proses" id="prosesEdit" class="mt-1 w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Sedang Diproses">Sedang Diproses</option>
                        <option value="Sudah Diproses">Sudah Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" onclick="closeModal('edit')" class="bg-gray-500 text-white rounded-lg px-6 py-3">Batal</button>
                <button type="submit" class="bg-blue-600 text-white rounded-lg px-6 py-3">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal
    function openModal(action) {
        const modal = document.getElementById(`transaksiModal${action === 'tambah' ? 'Tambah' : 'Edit'}`);
        const content = document.getElementById(`modalContent${action === 'tambah' ? 'Tambah' : 'Edit'}`);
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    // Fungsi untuk menutup modal
    function closeModal(action) {
        const modal = document.getElementById(`transaksiModal${action === 'tambah' ? 'Tambah' : 'Edit'}`);
        const content = document.getElementById(`modalContent${action === 'tambah' ? 'Tambah' : 'Edit'}`);
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Fungsi untuk edit modal
    function editModal(trx) {
        openModal('edit');
        document.getElementById('idEdit').value = trx.id_transaksi;
        document.getElementById('id_memberEdit').value = trx.id_member;
        document.getElementById('nama_pelangganEdit').value = trx.nama_pelanggan;
        document.getElementById('tanggalEdit').value = trx.tanggal;
        document.getElementById('beratEdit').value = trx.berat;
        document.getElementById('harga_per_kgEdit').value = trx.harga_per_kg;
        document.getElementById('totalEdit').value = trx.total;
        document.getElementById('statusEdit').value = trx.status;
        document.getElementById('prosesEdit').value = trx.proses;
    }

    // Fungsi hitung total untuk tambah transaksi
    function hitungTotalTambah() {
        const berat = parseFloat(document.getElementById('beratTambah').value);
        const harga = parseFloat(document.getElementById('harga_per_kgTambah').value);
        const total = berat * harga;
        document.getElementById('totalTambah').value = isNaN(total) ? 0 : total;
    }

    // Fungsi hitung total untuk edit transaksi
    function hitungTotalEdit() {
        const berat = parseFloat(document.getElementById('beratEdit').value);
        const harga = parseFloat(document.getElementById('harga_per_kgEdit').value);
        const total = berat * harga;
        document.getElementById('totalEdit').value = isNaN(total) ? 0 : total;
    }

    // Fungsi cek ID Member untuk transaksi baru
    function cekMember() {
        const idMember = document.getElementById('id_memberTambah').value;
        // Logic tambahan cek ID member
    }
</script>